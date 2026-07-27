<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    private function setupSearchData()
    {
        $categorySotuvId = DB::table('categories')->insertGetId([
            'name' => 'Sotuv',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $categoryIjaraId = DB::table('categories')->insertGetId([
            'name' => 'Ijara',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $subKvartiraId = DB::table('sub_categories')->insertGetId([
            'category_id' => $categorySotuvId,
            'name' => 'Kvartira',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $subHovliId = DB::table('sub_categories')->insertGetId([
            'category_id' => $categoryIjaraId,
            'name' => 'Hovli',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $regionId = DB::table('regions')->insertGetId([
            'name' => 'Toshkent shahri',
            'lat' => 41.3,
            'long' => 69.3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $cityId = DB::table('cities')->insertGetId([
            'region_id' => $regionId,
            'name' => 'Yashnobod tumani',
            'lat' => 41.3,
            'long' => 69.3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Product 1: Sotuv, Kvartira, Toshkent
        DB::table('products')->insert([
            'category_id' => $categorySotuvId,
            'subcategory_id' => $subKvartiraId,
            'region_id' => $regionId,
            'city_id' => $cityId,
            'name' => 'Premium Apartment',
            'price' => 65000,
            'status' => 'active',
            'rooms' => 2,
            'square' => 45,
            'floor' => 5,
            'building_floor' => 7,
            'repair' => 'Yevro ta\'mir',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Product 2: Ijara, Hovli, Toshkent
        DB::table('products')->insert([
            'category_id' => $categoryIjaraId,
            'subcategory_id' => $subHovliId,
            'region_id' => $regionId,
            'city_id' => $cityId,
            'name' => 'Cozy House',
            'price' => 1200,
            'status' => 'active',
            'rooms' => 4,
            'square' => 150,
            'floor' => 1,
            'building_floor' => 2,
            'repair' => 'O\'rtacha',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function test_can_access_search_page_without_parameters()
    {
        $response = $this->get('/maniDashboard');
        $response->assertStatus(200);
    }

    public function test_can_filter_by_transaction_type()
    {
        $this->setupSearchData();

        // Query for Sotuv
        $response = $this->get('/maniDashboard?transaction_type=Sotuv');
        $response->assertStatus(200);
        $response->assertSee('Premium Apartment');
        $response->assertDontSee('Cozy House');

        // Query for Ijara
        $response = $this->get('/maniDashboard?transaction_type=Ijara');
        $response->assertStatus(200);
        $response->assertSee('Cozy House');
        $response->assertDontSee('Premium Apartment');
    }

    public function test_can_filter_by_property_type()
    {
        $this->setupSearchData();

        // Query for Kvartira
        $response = $this->get('/maniDashboard?property_type=Kvartira');
        $response->assertStatus(200);
        $response->assertSee('Premium Apartment');
        $response->assertDontSee('Cozy House');
    }
}
