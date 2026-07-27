<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Region;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class ProductLimitTest extends TestCase
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

    public function test_client_is_restricted_to_two_products(): void
    {
        $clientRole = Role::where('name', 'client')->first();
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'username' => 'clientuser',
            'password' => bcrypt('password'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);

        $service = app(ProductService::class);
        $this->assertTrue($service->canUserCreateProduct($client));

        // Create 1st product
        Product::create(['name' => 'House 1', 'user_id' => $client->id, 'price' => 50000, 'square' => 50, 'rooms' => 2]);
        $this->assertTrue($service->canUserCreateProduct($client));

        // Create 2nd product
        Product::create(['name' => 'House 2', 'user_id' => $client->id, 'price' => 60000, 'square' => 60, 'rooms' => 3]);
        
        // 2 products exist, should return false for client
        $this->assertFalse($service->canUserCreateProduct($client));
    }

    public function test_makler_can_create_unlimited_products(): void
    {
        $maklerRole = Role::where('name', 'makler')->first();
        $makler = User::create([
            'name' => 'Makler User',
            'email' => 'makler@example.com',
            'username' => 'makleruser',
            'password' => bcrypt('password'),
            'role_id' => $maklerRole->id,
            'type' => 'makler',
        ]);

        $service = app(ProductService::class);

        // Create 3 products for Makler
        Product::create(['name' => 'House 1', 'user_id' => $makler->id, 'price' => 50000, 'square' => 50, 'rooms' => 2]);
        Product::create(['name' => 'House 2', 'user_id' => $makler->id, 'price' => 60000, 'square' => 60, 'rooms' => 3]);
        Product::create(['name' => 'House 3', 'user_id' => $makler->id, 'price' => 70000, 'square' => 70, 'rooms' => 4]);

        // Should still be able to create products
        $this->assertTrue($service->canUserCreateProduct($makler));
    }
}
