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
        $response->assertSee('Yangi hisob yaratish');
    }

    public function test_user_can_register_as_client(): void
    {
        $email = 'testclient-' . uniqid() . '@example.com';
        $username = 'testclient_' . uniqid();

        $response = $this->post('/register', [
            'name' => 'Test Client',
            'email' => $email,
            'username' => $username,
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'client',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => $username,
            'type' => 'client',
        ]);
    }

    public function test_user_can_register_as_makler(): void
    {
        $email = 'testmakler-' . uniqid() . '@example.com';
        $username = 'testmakler_' . uniqid();

        $response = $this->post('/register', [
            'name' => 'Test Makler',
            'email' => $email,
            'username' => $username,
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'makler',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => $username,
            'type' => 'makler',
        ]);
    }

    public function test_user_can_login_with_username(): void
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

    public function test_client_cannot_access_developer_dashboard(): void
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

        $response = $this->actingAs($user)->get('/developer/dashboard');
        $response->assertStatus(403);
    }

    public function test_developer_cannot_access_client_dashboard(): void
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

        $response = $this->actingAs($user)->get('/client/dashboard');
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
