<?php

namespace Tests\Feature;

use App\Jobs\SendCredentialsSmsJob;
use App\Models\Role;
use App\Models\SmsNotification;
use App\Models\User;
use App\Services\PasswordResetService;
use App\Services\UsmsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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

    private function sentPasswordFor(User $user): string
    {
        $password = null;
        Queue::assertPushed(SendCredentialsSmsJob::class, function ($job) use ($user, &$password) {
            $password = $job->password;
            return $job->phone === $user->phone;
        });

        return $password;
    }

    public function test_login_page_links_to_forgot_password_page(): void
    {
        $this->get('/login')->assertOk()->assertSee(route('password.request'));
        $this->get('/forgot-password')->assertOk()->assertSee('Parolni unutdingizmi?');
    }

    public function test_unknown_phone_is_rejected(): void
    {
        $this->post('/forgot-password', ['phone' => '+998 99 000 00 01'])
            ->assertSessionHasErrors('phone');

        Queue::assertNothingPushed();
    }

    public function test_invalid_phone_format_is_rejected(): void
    {
        $this->post('/forgot-password', ['phone' => '12345'])->assertSessionHasErrors('phone');
        Queue::assertNothingPushed();
    }

    public function test_registered_phone_gets_username_and_new_password_by_sms(): void
    {
        $user = $this->makeUser();

        $this->post('/forgot-password', ['phone' => $user->phone])
            ->assertRedirect(route('login'))
            ->assertSessionHas('success')
            ->assertSessionHasNoErrors();

        Queue::assertPushed(SendCredentialsSmsJob::class, fn ($job) => $job->username === $user->username);
        $password = $this->sentPasswordFor($user);

        $user->refresh();
        $this->assertTrue(Hash::check($password, $user->password));
        $this->assertFalse(Hash::check('old-password', $user->password));

        // Parol SMS tarixiga (admin panel) yozilmaydi
        $this->assertFalse(SmsNotification::where('message', 'like', "%{$password}%")->exists());

        // Yangi ma'lumotlar bilan tizimga kirish mumkin
        $this->post('/login', ['login' => $user->username, 'password' => $password])->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_phone_entered_in_any_format_is_found(): void
    {
        $digits = (string) random_int(1000000, 9999999);
        $user = $this->makeUser(['phone' => '+998 91 ' . substr($digits, 0, 3) . ' ' . substr($digits, 3, 2) . ' ' . substr($digits, 5)]);

        $this->post('/forgot-password', ['phone' => '91' . $digits])
            ->assertRedirect(route('login'))
            ->assertSessionHasNoErrors();

        Queue::assertPushed(SendCredentialsSmsJob::class, fn ($job) => $job->username === $user->username);
    }

    public function test_user_without_username_gets_generated_one(): void
    {
        $user = $this->makeUser(['username' => null]);

        $this->post('/forgot-password', ['phone' => $user->phone])->assertRedirect(route('login'));

        $user->refresh();
        $this->assertNotEmpty($user->username);
        Queue::assertPushed(SendCredentialsSmsJob::class, fn ($job) => $job->username === $user->username);
    }

    public function test_repeated_reset_for_same_phone_is_throttled(): void
    {
        $user = $this->makeUser();

        $this->post('/forgot-password', ['phone' => $user->phone])->assertSessionHasNoErrors();
        $password = $this->sentPasswordFor($user);

        $this->post('/forgot-password', ['phone' => $user->phone])->assertSessionHasErrors('phone');

        // Ikkinchi so'rov parolni yana o'zgartirmaydi
        Queue::assertPushed(SendCredentialsSmsJob::class, 1);
        $this->assertTrue(Hash::check($password, $user->fresh()->password));
    }

    public function test_reset_is_blocked_when_credentials_sms_template_is_not_configured(): void
    {
        config(['usms.mock_mode' => false, 'usms.login' => 'login', 'usms.secret' => 'secret', 'usms.password_reset_template_id' => 0]);
        $user = $this->makeUser();

        $this->post('/forgot-password', ['phone' => $user->phone])->assertSessionHasErrors('phone');

        Queue::assertNothingPushed();
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_mock_mode_shows_new_credentials_on_login_page(): void
    {
        $user = $this->makeUser();

        $this->followingRedirects()
            ->post('/forgot-password', ['phone' => $user->phone])
            ->assertOk()
            ->assertSee($user->username)
            ->assertSee('SMS test rejimi');
    }

    public function test_generated_password_is_readable_and_strong_enough(): void
    {
        $service = app(PasswordResetService::class);

        for ($i = 0; $i < 20; $i++) {
            $password = $service->generatePassword();
            $this->assertSame(8, strlen($password));
            $this->assertMatchesRegularExpression('/[a-zA-Z]/', $password);
            $this->assertMatchesRegularExpression('/\d/', $password);
            $this->assertDoesNotMatchRegularExpression('/[0O1lI]/', $password);
        }
    }

    public function test_credentials_job_sends_sms_and_marks_record_as_sent(): void
    {
        $record = SmsNotification::create([
            'phone' => '+998901112233',
            'message' => 'Parol tiklandi. Login: aziz, yangi parol SMS orqali yuborildi.',
            'status' => 'pending',
        ]);

        (new SendCredentialsSmsJob('+998901112233', 'aziz', 'Xk7mP2qa', $record->id))
            ->handle(app(UsmsService::class));

        $this->assertSame('sent', $record->fresh()->status);
    }

    public function test_authenticated_user_cannot_open_forgot_password(): void
    {
        $this->actingAs($this->makeUser())->get('/forgot-password')->assertRedirect();
    }
}
