<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeveloperCategoryTest extends TestCase
{
    use RefreshDatabase;

    private function createDeveloperUser(): User
    {
        $devRole = Role::firstOrCreate(['name' => 'dev']);
        return User::create([
            'name' => 'Developer User',
            'email' => 'dev-' . uniqid() . '@example.com',
            'username' => 'dev_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $devRole->id,
            'type' => 'dev',
        ]);
    }

    public function test_developer_can_edit_role(): void
    {
        $dev = $this->createDeveloperUser();
        $role = Role::create(['name' => 'moderator']);

        $response = $this->actingAs($dev)->get("/developer/roles/{$role->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($role->name);
    }

    public function test_developer_can_update_role(): void
    {
        $dev = $this->createDeveloperUser();
        $role = Role::create(['name' => 'moderator']);

        $response = $this->actingAs($dev)->put("/developer/roles/{$role->id}", [
            'name' => 'super_moderator',
        ]);

        $response->assertRedirect('/developer/roles');
        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'super_moderator',
        ]);
    }

    public function test_developer_cannot_delete_dev_role(): void
    {
        $dev = $this->createDeveloperUser();
        $devRole = Role::where('name', 'dev')->first();

        $response = $this->actingAs($dev)->delete("/developer/roles/{$devRole->id}");
        $response->assertRedirect('/developer/roles');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('roles', ['id' => $devRole->id]);
    }

    public function test_developer_cannot_delete_role_with_users(): void
    {
        $dev = $this->createDeveloperUser();
        $adminRole = Role::create(['name' => 'admin']);
        
        // Create a user with this role
        User::create([
            'name' => 'Admin User',
            'email' => 'admin-' . uniqid() . '@example.com',
            'username' => 'admin_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response = $this->actingAs($dev)->delete("/developer/roles/{$adminRole->id}");
        $response->assertRedirect('/developer/roles');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('roles', ['id' => $adminRole->id]);
    }

    public function test_developer_can_delete_unused_role(): void
    {
        $dev = $this->createDeveloperUser();
        $role = Role::create(['name' => 'unused_role']);

        $response = $this->actingAs($dev)->delete("/developer/roles/{$role->id}");
        $response->assertRedirect('/developer/roles');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }

    public function test_developer_can_view_categories_page(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'Real Estate']);
        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Apartments',
        ]);

        $response = $this->actingAs($dev)->get('/developer/categories');
        $response->assertStatus(200);
        $response->assertSee('Real Estate');
        $response->assertSee('Apartments');
    }

    public function test_developer_can_create_category(): void
    {
        $dev = $this->createDeveloperUser();

        $response = $this->actingAs($dev)->post('/developer/categories', [
            'name' => 'New Category',
        ]);

        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    public function test_developer_can_edit_and_update_category(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'Old Category']);

        $response = $this->actingAs($dev)->get("/developer/categories/{$category->id}/edit");
        $response->assertStatus(200);

        $response = $this->actingAs($dev)->put("/developer/categories/{$category->id}", [
            'name' => 'Updated Category',
        ]);

        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
        ]);
    }

    public function test_developer_can_delete_category(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'To Delete']);

        $response = $this->actingAs($dev)->delete("/developer/categories/{$category->id}");
        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_developer_can_create_subcategory(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'Cars']);

        $response = $this->actingAs($dev)->post('/developer/subcategories', [
            'category_id' => $category->id,
            'name' => 'Sedans',
        ]);

        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseHas('sub_categories', [
            'category_id' => $category->id,
            'name' => 'Sedans',
        ]);
    }

    public function test_developer_can_edit_and_update_subcategory(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'Cars']);
        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Sedans',
        ]);

        $response = $this->actingAs($dev)->get("/developer/subcategories/{$subCategory->id}/edit");
        $response->assertStatus(200);

        $response = $this->actingAs($dev)->put("/developer/subcategories/{$subCategory->id}", [
            'category_id' => $category->id,
            'name' => 'SUVs',
        ]);

        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseHas('sub_categories', [
            'id' => $subCategory->id,
            'name' => 'SUVs',
        ]);
    }

    public function test_developer_can_delete_subcategory(): void
    {
        $dev = $this->createDeveloperUser();
        $category = Category::create(['name' => 'Cars']);
        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Sedans',
        ]);

        $response = $this->actingAs($dev)->delete("/developer/subcategories/{$subCategory->id}");
        $response->assertRedirect('/developer/categories');
        $this->assertDatabaseMissing('sub_categories', ['id' => $subCategory->id]);
    }
}
