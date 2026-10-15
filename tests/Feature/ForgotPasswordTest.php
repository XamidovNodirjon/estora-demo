<?php

namespace Tests\Feature;

use App\Jobs\SendSmsJob;
use App\Mail\PasswordResetCodeMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();
        Queue::fake();
        Mail::fake();
        config(['usms.mock_mode' => true]);

        Role::firstOrCreate(['name' => 'client']);
    }

    private function makeUser(array $attributes = []): User
    {
        return User::create(array_merge([
            'first_name' => 'Aziz',
            'last_name' => 'Karimov',
            'username' => 'aziz_' . uniqid(),
            'email' => 'aziz-' . uniqid() . '@example.com',
            'phone' => '+99890' . random_int(1000000, 9999999),
            'password' => bcrypt('old-password'),
            'role_id' => Role::where('name', 'client')->first()->id,
            'type' => 'client',
        ], $attributes));
    }

    private function sendCode(array $payload)
    {
        return $this->postJson(route('password.send-code'), $payload);
    }

    private function emailedCode(User $user): string
    {
        $code = null;
        Mail::assertSent(PasswordResetCodeMail::class, function ($mail) use ($user, &$code) {
            $code = $mail->code;
            return $mail->hasTo($user->email);
        });

        return $code;
    }

    private function smsCode(User $user): string
    {
        $code = null;
        Queue::assertPushed(SendSmsJob::class, function ($job) use ($user, &$code) {
            $code = $job->code;
            return $job->phone === $user->phone;
        });

        return $code;
    }

    public function test_login_page_links_to_forgot_password_page(): void
    {
        $this->get('/login')->assertOk()->assertSee(route('password.request'));
        $this->get('/forgot-password')->assertOk()
            ->assertSee('Parolni unutdingizmi?')
            ->assertSee('Username esingizdami?');
    }

    public function test_username_with_email_receives_code_by_email(): void
    {
        $user = $this->makeUser();

        $response = $this->sendCode(['method' => 'username', 'username' => $user->username])
            ->assertOk()
            ->assertJson(['success' => true, 'channel' => 'email']);

        $code = $this->emailedCode($user);
        $this->assertMatchesRegularExpression('/^\d{6}$/', $code);
        // Log/array mailer (local, test) da kod ekranda ko'rsatiladi
        $this->assertSame($code, $response->json('mock_code'));
        Queue::assertNothingPushed();
    }

    public function test_email_code_is_not_exposed_when_real_mailer_is_used(): void
    {
        config(['mail.default' => 'smtp']);
        $user = $this->makeUser();

        $this->sendCode(['method' => 'username', 'username' => $user->username])
            ->assertOk()
            ->assertJsonMissingPath('mock_code');
    }

    public function test_username_without_email_receives_code_by_sms(): void
    {
        $user = $this->makeUser(['email' => null]);

        $this->sendCode(['method' => 'username', 'username' => $user->username])
            ->assertOk()
            ->assertJson(['channel' => 'sms'])
            ->assertJsonPath('destination', '+998 90 *** ** ' . substr($user->phone, -2));

        $this->assertNotEmpty($this->smsCode($user));
        Mail::assertNothingSent();
    }

    public function test_phone_method_always_sends_sms_even_if_user_has_email(): void
    {
        $user = $this->makeUser();

        $this->sendCode(['method' => 'phone', 'phone' => '+998 ' . substr($user->phone, 4)])
            ->assertOk()
            ->assertJson(['channel' => 'sms']);

        $this->smsCode($user);
        Mail::assertNothingSent();
    }

    public function test_mock_sms_mode_returns_code_for_testing(): void
    {
        $user = $this->makeUser(['email' => null]);

        $response = $this->sendCode(['method' => 'phone', 'phone' => $user->phone])->assertOk();

        $this->assertSame($this->smsCode($user), $response->json('mock_code'));
    }

    public function test_unknown_username_or_phone_is_rejected(): void
    {
        $this->sendCode(['method' => 'username', 'username' => 'nobody_here'])
            ->assertStatus(422)->assertJsonValidationErrors('username');

        $this->sendCode(['method' => 'phone', 'phone' => '+998 99 000 00 01'])
            ->assertStatus(422)->assertJsonValidationErrors('phone');

        $this->sendCode(['method' => 'phone', 'phone' => '12345'])
            ->assertStatus(422)->assertJsonValidationErrors('phone');

        Queue::assertNothingPushed();
        Mail::assertNothingSent();
    }

    public function test_full_flow_shows_username_and_updates_only_password(): void
    {
        $user = $this->makeUser();

        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();

        $this->postJson(route('password.verify-code'), ['code' => $this->emailedCode($user)])
            ->assertOk()
            ->assertJson(['success' => true, 'username' => $user->username]);

        $this->postJson(route('password.reset'), [
            'username' => $user->username,
            'password' => 'new-secret',
            'password_confirmation' => 'new-secret',
        ])->assertOk()->assertJson(['redirect' => route('login')]);

        $user->refresh();
        $this->assertTrue(Hash::check('new-secret', $user->password));

        $this->post('/login', ['login' => $user->username, 'password' => 'new-secret'])->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_change_username_while_resetting(): void
    {
        $user = $this->makeUser(['email' => null]);

        $this->sendCode(['method' => 'phone', 'phone' => $user->phone])->assertOk();
        $this->postJson(route('password.verify-code'), ['code' => $this->smsCode($user)])->assertOk();

        $this->postJson(route('password.reset'), [
            'username' => 'aziz_new_login',
            'password' => 'new-secret',
            'password_confirmation' => 'new-secret',
        ])->assertOk();

        $user->refresh();
        $this->assertSame('aziz_new_login', $user->username);
        $this->assertTrue(Hash::check('new-secret', $user->password));
    }

    public function test_user_without_username_gets_suggested_one(): void
    {
        $user = $this->makeUser(['username' => null, 'email' => null]);

        $this->sendCode(['method' => 'phone', 'phone' => $user->phone])->assertOk();
        $username = $this->postJson(route('password.verify-code'), ['code' => $this->smsCode($user)])
            ->assertOk()
            ->json('username');

        $this->assertSame('aziz_karimov', $username);
    }

    public function test_wrong_code_is_rejected_and_attempts_are_limited(): void
    {
        $user = $this->makeUser();
        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();
        $code = $this->emailedCode($user);
        $wrong = $code === '111111' ? '222222' : '111111';

        for ($i = 0; $i < 5; $i++) {
            $this->postJson(route('password.verify-code'), ['code' => $wrong])->assertStatus(422);
        }

        // 5 ta xato urinishdan keyin to'g'ri kod ham qabul qilinmaydi
        $this->postJson(route('password.verify-code'), ['code' => $code])->assertStatus(422);
    }

    public function test_password_cannot_be_reset_without_verified_code(): void
    {
        $user = $this->makeUser();
        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();

        $this->postJson(route('password.reset'), [
            'username' => $user->username,
            'password' => 'new-secret',
            'password_confirmation' => 'new-secret',
        ])->assertStatus(422)->assertJsonValidationErrors('password');

        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_reset_validates_confirmation_and_username_uniqueness(): void
    {
        $other = $this->makeUser();
        $user = $this->makeUser();

        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();
        $this->postJson(route('password.verify-code'), ['code' => $this->emailedCode($user)])->assertOk();

        $this->postJson(route('password.reset'), [
            'username' => $user->username,
            'password' => 'new-secret',
            'password_confirmation' => 'different',
        ])->assertStatus(422)->assertJsonValidationErrors('password');

        $this->postJson(route('password.reset'), [
            'username' => $other->username,
            'password' => 'new-secret',
            'password_confirmation' => 'new-secret',
        ])->assertStatus(422)->assertJsonValidationErrors('username');

        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_code_cannot_be_used_after_successful_reset(): void
    {
        $user = $this->makeUser();
        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();
        $code = $this->emailedCode($user);

        $this->postJson(route('password.verify-code'), ['code' => $code])->assertOk();
        $this->postJson(route('password.reset'), [
            'username' => $user->username,
            'password' => 'new-secret',
            'password_confirmation' => 'new-secret',
        ])->assertOk();

        $this->postJson(route('password.verify-code'), ['code' => $code])->assertStatus(422);
        $this->postJson(route('password.reset'), [
            'username' => $user->username,
            'password' => 'another-secret',
            'password_confirmation' => 'another-secret',
        ])->assertStatus(422);
    }

    public function test_resending_code_is_throttled(): void
    {
        $user = $this->makeUser();

        $this->sendCode(['method' => 'username', 'username' => $user->username])->assertOk();
        $this->sendCode(['method' => 'username', 'username' => $user->username])
            ->assertStatus(422)->assertJsonValidationErrors('username');

        Mail::assertSent(PasswordResetCodeMail::class, 1);
    }

    public function test_authenticated_user_cannot_open_forgot_password(): void
    {
        $this->actingAs($this->makeUser())->get('/forgot-password')->assertRedirect();
    }
}
