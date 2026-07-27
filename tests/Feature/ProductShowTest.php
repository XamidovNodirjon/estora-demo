<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Region;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Metro;
use App\Models\University;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_access_product_show_page_with_details_and_recommendations(): void
    {
        // 1. Setup mock data
        $category = Category::create(['name' => 'Sotuv']);
        $subCategory = SubCategory::create(['category_id' => $category->id, 'name' => 'Kvartira']);
        $region = Region::create(['name' => 'Toshkent', 'lat' => 41.31, 'long' => 69.24]);
        $city = City::create([
            'region_id' => $region->id,
            'name' => 'Chilonzor',
            'lat' => 41.31,
            'long' => 69.24
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'subcategory_id' => $subCategory->id,
            'region_id' => $region->id,
            'city_id' => $city->id,
            'name' => 'Show Test Apartment',
            'price' => 50000,
            'description' => 'Beautiful show apartment detail description.',
            'square' => 75,
            'rooms' => 3,
            'repair' => 'Yevro',
            'phone' => '+998901234567',
            'status' => 'active'
        ]);

        // Add Product Item, Metro, University
        $item = ProductItem::create([
            'name' => 'Conditioner',
            'product_id' => $product->id
        ]);
        $metro = Metro::create(['name' => 'Chilonzor']);
        $product->metros()->attach($metro->id);

        $university = University::create(['name' => 'TTPU']);
        $product->universities()->attach($university->id);

        // Create a similar product for recommendation tests
        $similar = Product::create([
            'category_id' => $category->id,
            'subcategory_id' => $subCategory->id,
            'region_id' => $region->id,
            'city_id' => $city->id,
            'name' => 'Recommended Apartment',
            'price' => 51000,
            'square' => 74,
            'rooms' => 3,
            'status' => 'active'
        ]);

        // 2. Perform Request
        $response = $this->get("/products/{$product->id}");

        // 3. Assertions
        $response->assertStatus(200);
        $response->assertSee('Show Test Apartment');
        $response->assertSee('50,000 USD');
        $response->assertSee('75 m²');
        $response->assertSee('3 xona');
        $response->assertSee('Beautiful show apartment detail description.');
        $response->assertSee('Conditioner');
        $response->assertSee('Chilonzor Metro');
        $response->assertSee('TTPU');
        
        // Assert recommendation card is present
        $response->assertSee('Recommended Apartment');
    }
}
