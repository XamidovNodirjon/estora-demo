<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class DeveloperTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();

        // Clean up database tables manually to support MyISAM or SQLite without transactions
        User::query()->delete();

        // Seed default roles
        $roles = ['dev', 'admin', 'manager', 'client'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    private function createDeveloperUser()
    {
        $devRole = Role::where('name', 'dev')->first();
        return User::create([
            'name' => 'Developer User',
            'email' => 'dev-' . uniqid() . '@example.com',
            'username' => 'dev_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);
    }

    public function test_guest_cannot_access_developer_management(): void
    {
        $response = $this->get('/developer/users');
        $response->assertRedirect('/login');

        $response = $this->get('/developer/roles');
        $response->assertRedirect('/login');
    }

    public function test_client_cannot_access_developer_management(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client-' . uniqid() . '@example.com',
            'username' => 'client_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->actingAs($client)->get('/developer/users');
        $response->assertStatus(403);

        $response = $this->actingAs($client)->get('/developer/roles');
        $response->assertStatus(403);
    }

    public function test_developer_can_access_management_pages(): void
    {
        $dev = $this->createDeveloperUser();

        $response = $this->actingAs($dev)->get('/developer/users');
        $response->assertStatus(200);
        $response->assertSee('Tizim Foydalanuvchilari');

        $response = $this->actingAs($dev)->get('/developer/roles');
        $response->assertStatus(200);
        $response->assertSee('Mavjud Rollar');
    }

    public function test_developer_can_create_new_role(): void
    {
        $dev = $this->createDeveloperUser();

        $response = $this->actingAs($dev)->post('/developer/roles', [
            'name' => 'editor',
        ]);

        $response->assertRedirect('/developer/roles');
        $this->assertDatabaseHas('roles', [
            'name' => 'editor',
        ]);
    }

    public function test_developer_can_create_universal_user(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::where('name', 'admin')->first();
        $email = 'newadmin-' . uniqid() . '@example.com';
        $username = 'newadmin_' . uniqid();

        $response = $this->actingAs($dev)->post('/developer/users', [
            'name' => 'New Admin User',
            'email' => $email,
            'username' => $username,
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response->assertRedirect('/developer/users');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => $username,
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);
    }

    public function test_developer_can_create_user_without_phone(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::where('name', 'admin')->first();
        $email = 'newadmin-' . uniqid() . '@example.com';
        $username = 'newadmin_' . uniqid();

        $response = $this->actingAs($dev)->post('/developer/users', [
            'name' => 'New Admin User',
            'email' => $email,
            'username' => $username,
            'password' => 'password123',
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response->assertRedirect('/developer/users');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => $username,
            'phone' => null,
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);
    }

    public function test_developer_can_edit_user(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::where('name', 'admin')->first();
        $user = User::create([
            'name' => 'Target User',
            'email' => 'target-' . uniqid() . '@example.com',
            'username' => 'target_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response = $this->actingAs($dev)->get("/developer/users/{$user->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_developer_can_update_user(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::where('name', 'admin')->first();
        $user = User::create([
            'name' => 'Target User',
            'email' => 'target-' . uniqid() . '@example.com',
            'username' => 'target_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response = $this->actingAs($dev)->put("/developer/users/{$user->id}", [
            'name' => 'Updated User Name',
            'email' => 'updated-' . uniqid() . '@example.com',
            'username' => 'updated_' . uniqid(),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response->assertRedirect('/developer/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User Name',
        ]);
    }

    public function test_developer_cannot_delete_self(): void
    {
        $dev = $this->createDeveloperUser();

        $response = $this->actingAs($dev)->delete("/developer/users/{$dev->id}");
        $response->assertRedirect('/developer/users');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $dev->id]);
    }

    public function test_developer_can_delete_other_user(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::where('name', 'admin')->first();
        $user = User::create([
            'name' => 'Target User',
            'email' => 'target-' . uniqid() . '@example.com',
            'username' => 'target_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response = $this->actingAs($dev)->delete("/developer/users/{$user->id}");
        $response->assertRedirect('/developer/users');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
