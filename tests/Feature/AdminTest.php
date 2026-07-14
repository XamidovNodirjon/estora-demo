<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class AdminTest extends TestCase
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

    private function createAdminUser()
    {
        $adminRole = Role::where('name', 'admin')->first();
        return User::create([
            'name' => 'Admin User',
            'email' => 'admin-' . uniqid() . '@example.com',
            'username' => 'admin_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);
    }

    public function test_guest_cannot_access_admin_management(): void
    {
        $response = $this->get('/admin/users');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/users/create');
        $response->assertRedirect('/login');
    }

    public function test_client_cannot_access_admin_management(): void
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

        $response = $this->actingAs($client)->get('/admin/users');
        $response->assertStatus(403);

        $response = $this->actingAs($client)->get('/admin/users/create');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_management_pages(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertSee('Tizim foydalanuvchilari');

        $response = $this->actingAs($admin)->get('/admin/users/create');
        $response->assertStatus(200);
        $response->assertSee("Yangi foydalanuvchi qo'shish", false);
    }

    public function test_admin_cannot_see_dev_users_in_list(): void
    {
        $admin = $this->createAdminUser();
        
        $devRole = Role::where('name', 'dev')->first();
        $devUser = User::create([
            'name' => 'Developer John',
            'email' => 'john-' . uniqid() . '@example.com',
            'username' => 'john_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
        $users = $response->viewData('users');
        $this->assertFalse($users->contains($devUser));
    }

    public function test_admin_cannot_create_dev_user(): void
    {
        $admin = $this->createAdminUser();
        $devRole = Role::where('name', 'dev')->first();

        // Try creating dev user
        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Fake Dev',
            'email' => 'fakedev@example.com',
            'username' => 'fakedev',
            'phone' => '+998901111111',
            'password' => 'password123',
            'role_id' => $devRole->id,
            'type' => 'dev', // Not in admin,manager,client
        ]);

        $response->assertSessionHasErrors(['role_id', 'type']);
        $this->assertDatabaseMissing('users', [
            'email' => 'fakedev@example.com',
        ]);
    }

    public function test_admin_can_create_manager_or_client_user(): void
    {
        $admin = $this->createAdminUser();
        $managerRole = Role::where('name', 'manager')->first();
        $email = 'manager-' . uniqid() . '@example.com';
        $username = 'manager_' . uniqid();

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'New Manager',
            'email' => $email,
            'username' => $username,
            'phone' => '+99890' . rand(1000000, 9999999),
            'password' => 'password123',
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => $username,
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);
    }

    public function test_admin_can_create_user_without_phone_and_username(): void
    {
        $admin = $this->createAdminUser();
        $clientRole = Role::where('name', 'client')->first();
        $email = 'client-' . uniqid() . '@example.com';

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Optional Fields Client',
            'email' => $email,
            'password' => 'password123',
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'username' => null,
            'phone' => null,
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);
    }

    public function test_admin_can_filter_users_by_staff_tab(): void
    {
        $admin = $this->createAdminUser();
        $clientRole = Role::where('name', 'client')->first();
        
        $clientUser = User::create([
            'name' => 'Should Not See Client',
            'email' => 'client-' . uniqid() . '@example.com',
            'username' => 'client_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->actingAs($admin)->get('/admin/users?tab=staff');
        $response->assertStatus(200);
        
        $users = $response->viewData('users');
        $this->assertTrue($users->contains($admin));
        $this->assertFalse($users->contains($clientUser));
    }

    public function test_admin_can_filter_users_by_clients_tab(): void
    {
        $admin = $this->createAdminUser();
        $clientRole = Role::where('name', 'client')->first();
        
        $clientUser = User::create([
            'name' => 'Should See Client',
            'email' => 'client-' . uniqid() . '@example.com',
            'username' => 'client_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $response = $this->actingAs($admin)->get('/admin/users?tab=clients');
        $response->assertStatus(200);
        
        $users = $response->viewData('users');
        $this->assertTrue($users->contains($clientUser));
        $this->assertFalse($users->contains($admin));
    }

    public function test_admin_can_edit_user(): void
    {
        $admin = $this->createAdminUser();
        $managerRole = Role::where('name', 'manager')->first();
        $user = User::create([
            'name' => 'Manager User',
            'email' => 'manager-' . uniqid() . '@example.com',
            'username' => 'manager_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);

        $response = $this->actingAs($admin)->get("/admin/users/{$user->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_admin_cannot_edit_dev_user(): void
    {
        $admin = $this->createAdminUser();
        $devRole = Role::where('name', 'dev')->first();
        $devUser = User::create([
            'name' => 'Dev User',
            'email' => 'dev-' . uniqid() . '@example.com',
            'username' => 'dev_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);

        $response = $this->actingAs($admin)->get("/admin/users/{$devUser->id}/edit");
        $response->assertStatus(403);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = $this->createAdminUser();
        $managerRole = Role::where('name', 'manager')->first();
        $user = User::create([
            'name' => 'Manager User',
            'email' => 'manager-' . uniqid() . '@example.com',
            'username' => 'manager_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);

        $response = $this->actingAs($admin)->put("/admin/users/{$user->id}", [
            'name' => 'Updated Manager Name',
            'email' => 'updatedmanager-' . uniqid() . '@example.com',
            'username' => 'updatedmanager_' . uniqid(),
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Manager Name',
        ]);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_admin_can_delete_other_user(): void
    {
        $admin = $this->createAdminUser();
        $managerRole = Role::where('name', 'manager')->first();
        $user = User::create([
            'name' => 'Manager User',
            'email' => 'manager-' . uniqid() . '@example.com',
            'username' => 'manager_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $managerRole->id,
            'type' => 'manager',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/users/{$user->id}");
        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_manage_categories(): void
    {
        $admin = $this->createAdminUser();

        // 1. View categories index
        $response = $this->actingAs($admin)->get('/admin/categories');
        $response->assertStatus(200);

        // 2. Create category
        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Admin Test Category',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Admin Test Category']);

        // 3. Edit category view
        $category = \App\Models\Category::where('name', 'Admin Test Category')->first();
        $response = $this->actingAs($admin)->get("/admin/categories/{$category->id}/edit");
        $response->assertStatus(200);

        // 4. Update category
        $response = $this->actingAs($admin)->put("/admin/categories/{$category->id}", [
            'name' => 'Admin Updated Category',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Admin Updated Category']);

        // 5. Create subcategory
        $response = $this->actingAs($admin)->post('/admin/subcategories', [
            'category_id' => $category->id,
            'name' => 'Admin Test Subcategory',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('sub_categories', ['name' => 'Admin Test Subcategory']);

        // 6. Delete category
        $response = $this->actingAs($admin)->delete("/admin/categories/{$category->id}");
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
