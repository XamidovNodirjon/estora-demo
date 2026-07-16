<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Region;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();

        // Seed roles
        $roles = ['dev', 'admin', 'manager', 'client'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Seed default product item templates
        $items = ['Lift', 'Balkon', 'Parkovka', 'Bolalar maydonchasi'];
        foreach ($items as $name) {
            ProductItem::firstOrCreate([
                'name' => $name,
                'product_id' => null,
            ]);
        }
    }

    private function createAdminUser(): User
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

    private function setupProductDependencies(): array
    {
        $category = Category::create(['name' => 'Real Estate']);
        $subcategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Apartments',
        ]);

        $region = Region::create([
            'name' => 'Tashkent',
            'lat' => 41.2995,
            'long' => 69.2401,
        ]);
        $city = City::create([
            'region_id' => $region->id,
            'name' => 'Chilonzor',
            'lat' => 41.2995,
            'long' => 69.2401,
        ]);

        return compact('category', 'subcategory', 'region', 'city');
    }

    public function test_admin_can_view_products_list(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/admin/products');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_product_with_items(): void
    {
        $admin = $this->createAdminUser();
        $deps = $this->setupProductDependencies();

        $response = $this->actingAs($admin)->post('/admin/products', [
            'category_id' => $deps['category']->id,
            'subcategory_id' => $deps['subcategory']->id,
            'name' => 'Luxury Apartment',
            'price' => 750000000,
            'description' => 'A beautiful luxury apartment in Chilonzor',
            'region_id' => $deps['region']->id,
            'city_id' => $deps['city']->id,
            'phone' => '+998901234567',
            'rooms' => 3,
            'square' => 85,
            'floor' => 4,
            'building_floor' => 9,
            'repair' => 'Evro',
            'exchange' => 1,
            'pay_in_installments' => 0,
            'credit' => 1,
            'items' => ['Lift', 'Balkon'],
            'latitude' => 41.3111,
            'longitude' => 69.2797,
        ]);

        $response->assertRedirect('/admin/products');
        
        $product = Product::where('name', 'Luxury Apartment')->first();
        $this->assertNotNull($product);
        $this->assertEquals(750000000, $product->price);
        $this->assertEquals(41.3111, $product->latitude);
        $this->assertEquals(69.2797, $product->longitude);

        // Verify product items were duplicated/synced under the product
        $this->assertDatabaseHas('product_items', [
            'name' => 'Lift',
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseHas('product_items', [
            'name' => 'Balkon',
            'product_id' => $product->id,
        ]);

        // Verify base templates are unchanged
        $this->assertDatabaseHas('product_items', [
            'name' => 'Lift',
            'product_id' => null,
        ]);
    }

    public function test_admin_can_edit_and_update_product_with_items(): void
    {
        $admin = $this->createAdminUser();
        $deps = $this->setupProductDependencies();

        $product = Product::create([
            'category_id' => $deps['category']->id,
            'subcategory_id' => $deps['subcategory']->id,
            'user_id' => $admin->id,
            'name' => 'Luxury Apartment',
            'price' => 750000000,
            'description' => 'Description',
            'region_id' => $deps['region']->id,
            'city_id' => $deps['city']->id,
            'phone' => '+998901234567',
            'rooms' => 3,
            'square' => 85,
            'floor' => 4,
            'building_floor' => 9,
            'repair' => 'Evro',
        ]);

        ProductItem::create([
            'name' => 'Lift',
            'product_id' => $product->id,
        ]);

        // Edit view
        $response = $this->actingAs($admin)->get("/admin/products/{$product->id}/edit");
        $response->assertStatus(200);

        // Update action
        $response = $this->actingAs($admin)->put("/admin/products/{$product->id}", [
            'category_id' => $deps['category']->id,
            'subcategory_id' => $deps['subcategory']->id,
            'name' => 'Updated Apartment Title',
            'price' => 800000000,
            'description' => 'Updated description',
            'region_id' => $deps['region']->id,
            'city_id' => $deps['city']->id,
            'phone' => '+998901234567',
            'rooms' => 3,
            'square' => 85,
            'floor' => 4,
            'building_floor' => 9,
            'repair' => 'Evro',
            'items' => ['Balkon', 'Parkovka'], // Remove Lift, add Balkon and Parkovka
            'latitude' => 41.3122,
            'longitude' => 69.2808,
        ]);

        $response->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Apartment Title',
            'price' => 800000000,
            'latitude' => 41.3122,
            'longitude' => 69.2808,
        ]);

        // Verify synced items
        $this->assertDatabaseMissing('product_items', [
            'name' => 'Lift',
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseHas('product_items', [
            'name' => 'Balkon',
            'product_id' => $product->id,
        ]);
        $this->assertDatabaseHas('product_items', [
            'name' => 'Parkovka',
            'product_id' => $product->id,
        ]);
    }

    public function test_admin_can_delete_product_cascades_items(): void
    {
        $admin = $this->createAdminUser();
        $deps = $this->setupProductDependencies();

        $product = Product::create([
            'category_id' => $deps['category']->id,
            'subcategory_id' => $deps['subcategory']->id,
            'user_id' => $admin->id,
            'name' => 'Apartment to Delete',
            'price' => 500000000,
            'description' => 'Description',
            'region_id' => $deps['region']->id,
            'city_id' => $deps['city']->id,
            'phone' => '+998901234567',
            'rooms' => 3,
            'square' => 85,
        ]);

        ProductItem::create([
            'name' => 'Lift',
            'product_id' => $product->id,
        ]);

        $response = $this->actingAs($admin)->delete("/admin/products/{$product->id}");
        $response->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('product_items', [
            'name' => 'Lift',
            'product_id' => $product->id,
        ]);
    }
}
