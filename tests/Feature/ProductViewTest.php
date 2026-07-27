<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Region;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class ProductViewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();

        foreach (['dev', 'admin', 'manager', 'client', 'makler'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    public function test_viewing_product_records_entry_in_product_views_table(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $owner = User::create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'username' => 'owneruser',
            'password' => bcrypt('password'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $category = Category::create(['name' => 'Kvartiralar']);
        $sub = SubCategory::create(['name' => 'Sotuv', 'category_id' => $category->id]);
        $region = Region::create(['name' => 'Toshkent', 'lat' => 41.3, 'long' => 69.2]);
        $city = City::create(['name' => 'Chilonzor', 'region_id' => $region->id, 'lat' => 41.3, 'long' => 69.2]);

        $product = Product::create([
            'name' => 'Chilonzor 3 xonali',
            'price' => 85000000,
            'square' => 70,
            'rooms' => 3,
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'subcategory_id' => $sub->id,
            'region_id' => $region->id,
            'city_id' => $city->id,
            'phone' => '+998901234567',
            'description' => 'Ajoyib xonadon',
        ]);

        // 1. Visit product page as guest
        $response = $this->get(route('products.show', $product->id));
        $response->assertStatus(200);
        $this->assertDatabaseHas('product_views', [
            'product_id' => $product->id,
            'user_id' => null,
        ]);

        // Verify guest does NOT see private owner statistics badge
        $response->assertDontSee('Maxsus statistika');

        // 2. Visit product page as the owner
        $ownerResponse = $this->actingAs($owner)->get(route('products.show', $product->id));
        $ownerResponse->assertStatus(200);
        
        // Verify owner sees the private stats badge
        $ownerResponse->assertSee('Maxsus statistika');
        $ownerResponse->assertSee("2 ta ko'rishlar", false);

        // 3. Verify product_views has 2 entries now
        $this->assertEquals(2, ProductView::where('product_id', $product->id)->count());
    }
}
