<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function migrateFreshUsing()
    {
        return [
            '--path' => str_replace('\\', '/', base_path('database/migrations')),
            '--realpath' => true,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock Vite so tests don't fail due to missing built assets
        Vite::spy();

        // Seed roles for testing
        $roles = ['dev', 'admin', 'manager', 'client', 'makler'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Tizimga kirish');
    }

    public function test_register_page_renders(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Hisob turini tanlang');
    }

    public function test_user_can_register_with_first_and_last_name_and_auto_generates_username(): void
    {
        $phone = '+99890' . rand(1000000, 9999999);

        $response = $this->post('/register', [
            'last_name' => 'Xamidov',
            'first_name' => 'Nodirjon',
            'phone' => $phone,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'client',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'last_name' => 'Xamidov',
            'first_name' => 'Nodirjon',
            'username' => 'xamidov_nodirjon',
            'email' => null,
            'type' => 'client',
        ]);
    }

    public function test_duplicate_name_registration_generates_unique_username(): void
    {
        // First user
        $this->post('/register', [
            'last_name' => 'Xamidov',
            'first_name' => 'Nodirjon',
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'client',
        ]);

        // Second user with same name
        $this->post('/register', [
            'last_name' => 'Xamidov',
            'first_name' => 'Nodirjon',
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'makler',
        ]);

        $this->assertDatabaseHas('users', [
            'username' => 'xamidov_nodirjon',
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'xamidov_nodirjon_1',
        ]);
    }

    public function test_user_can_send_verification_code_and_verify_email(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $clientRole = Role::where('name', 'client')->first();
        $user = User::create([
            'name' => 'Xamidov Nodirjon',
            'first_name' => 'Nodirjon',
            'last_name' => 'Xamidov',
            'username' => 'xamidov_nodirjon_' . uniqid(),
            'email' => null,
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        // Send verification code with email
        $verifyEmail = 'xamidov-' . uniqid() . '@example.com';
        $sendResponse = $this->actingAs($user)->postJson('/email/send-code', [
            'email' => $verifyEmail,
        ]);

        $sendResponse->assertStatus(200);
        $sendResponse->assertJson(['success' => true]);

        // Check user now has the email saved
        $user->refresh();
        $this->assertEquals($verifyEmail, $user->email);
        $this->assertNull($user->email_verified_at);

        // Get cached code
        $cachedCode = \Illuminate\Support\Facades\Cache::get('email_verification_code_' . $user->id);
        $this->assertNotEmpty($cachedCode);

        // Verify code
        $verifyResponse = $this->actingAs($user)->postJson('/email/verify-code', [
            'code' => $cachedCode,
        ]);

        $verifyResponse->assertStatus(200);
        $verifyResponse->assertJson(['success' => true]);

        $user->refresh();
        $this->assertNotNull($user->email_verified_at);
    }

    public function test_user_can_login_with_username(): void
    {
        $devRole = Role::where('name', 'dev')->first();
        $username = 'dev_' . uniqid();

        $user = User::create([
            'name' => 'Developer User',
            'username' => $username,
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);

        $response = $this->post('/login', [
            'login' => $username,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_email(): void
    {
        $devRole = Role::where('name', 'dev')->first();
        $username = 'dev_' . uniqid();
        $email = $username . '@example.com';

        $user = User::create([
            'name' => 'Developer User',
            'email' => $email,
            'username' => $username,
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);

        $response = $this->post('/login', [
            'login' => $email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_phone(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $phone = '+99890' . rand(1000000, 9999999);

        $user = User::create([
            'name' => 'Phone User',
            'phone' => $phone,
            'username' => 'phone_user_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->post('/login', [
            'login' => $phone,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_client_cannot_access_developer_dashboard(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $username = 'client_' . uniqid();

        $user = User::create([
            'name' => 'Client User',
            'username' => $username,
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->actingAs($user)->get('/developer/dashboard');
        $response->assertStatus(403);
    }

    public function test_user_can_logout(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $username = 'client_' . uniqid();
        $email = $username . '@example.com';

        $user = User::create([
            'name' => 'Client User',
            'email' => $email,
            'username' => $username,
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
