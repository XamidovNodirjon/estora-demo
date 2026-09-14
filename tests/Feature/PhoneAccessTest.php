<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductPhoneView;
use App\Models\Region;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class PhoneAccessTest extends TestCase
{
    use DatabaseTransactions;

    protected User $maklerUser;
    protected User $ownerUser;
    protected User $regularViewer;
    protected Product $maklerProduct;
    protected Product $ownerProduct;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();

        $maklerRole = Role::firstOrCreate(['name' => 'makler']);
        $ownerRole = Role::firstOrCreate(['name' => 'owner']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        $suffix = uniqid();

        $this->maklerUser = User::create([
            'first_name' => 'Ali',
            'last_name' => 'Makler',
            'name' => 'Ali Makler',
            'username' => 'makler_' . $suffix,
            'email' => 'makler_' . $suffix . '@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $maklerRole->id,
            'type' => 'makler',
            'phone' => '+99890' . rand(1000000, 9999999),
        ]);

        $this->ownerUser = User::create([
            'first_name' => 'Vali',
            'last_name' => 'Uy Egasi',
            'name' => 'Vali Uy Egasi',
            'username' => 'owner_' . $suffix,
            'email' => 'owner_' . $suffix . '@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $ownerRole->id,
            'type' => 'owner',
            'phone' => '+99891' . rand(1000000, 9999999),
        ]);

        $this->regularViewer = User::create([
            'first_name' => 'Sardor',
            'last_name' => 'Mijoz',
            'name' => 'Sardor Mijoz',
            'username' => 'viewer_' . $suffix,
            'email' => 'viewer_' . $suffix . '@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
            'phone' => '+99893' . rand(1000000, 9999999),
        ]);

        $this->maklerProduct = Product::create([
            'user_id' => $this->maklerUser->id,
            'name' => 'Chilonzor 2 xonali makler uyi',
            'price' => 55000,
            'phone' => '+998901112233',
            'rooms' => 2,
            'square' => 60,
        ]);

        $this->ownerProduct = Product::create([
            'user_id' => $this->ownerUser->id,
            'name' => 'Yunusobod 3 xonali uy egasidan',
            'price' => 75000,
            'phone' => '+998909998877',
            'rooms' => 3,
            'square' => 85,
        ]);
    }

    public function test_guest_can_reveal_makler_phone(): void
    {
        $response = $this->postJson(route('products.reveal-phone', $this->maklerProduct->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'phone' => '+998901112233',
            'is_makler' => true,
        ]);

        $this->assertEquals(1, $this->maklerProduct->fresh()->phone_views_count);
        $this->assertDatabaseHas('product_phone_views', [
            'product_id' => $this->maklerProduct->id,
            'seller_id' => $this->maklerUser->id,
            'seller_role' => 'makler',
            'viewer_id' => null,
        ]);
    }

    public function test_guest_cannot_reveal_owner_phone(): void
    {
        $response = $this->postJson(route('products.reveal-phone', $this->ownerProduct->id));

        $response->assertStatus(401);
        $response->assertJson([
            'success' => false,
            'require_auth' => true,
        ]);

        $this->assertEquals(0, $this->ownerProduct->fresh()->phone_views_count);
        $this->assertDatabaseMissing('product_phone_views', [
            'product_id' => $this->ownerProduct->id,
        ]);
    }

    public function test_authenticated_user_can_reveal_owner_phone(): void
    {
        $response = $this->actingAs($this->regularViewer)
            ->postJson(route('products.reveal-phone', $this->ownerProduct->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'phone' => '+998909998877',
            'is_makler' => false,
        ]);

        $this->assertEquals(1, $this->ownerProduct->fresh()->phone_views_count);
        $this->assertDatabaseHas('product_phone_views', [
            'product_id' => $this->ownerProduct->id,
            'seller_id' => $this->ownerUser->id,
            'seller_role' => 'owner',
            'viewer_id' => $this->regularViewer->id,
        ]);
    }

    public function test_owner_themselves_can_always_reveal_their_own_phone(): void
    {
        $response = $this->actingAs($this->ownerUser)
            ->postJson(route('products.reveal-phone', $this->ownerProduct->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'phone' => '+998909998877',
        ]);
    }

    public function test_admin_can_always_reveal_any_phone(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'name' => 'Admin System',
            'username' => 'admin_' . uniqid(),
            'email' => 'admin_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $adminRole->id,
            'type' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->postJson(route('products.reveal-phone', $this->ownerProduct->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'phone' => '+998909998877',
        ]);
    }

    public function test_product_helper_methods(): void
    {
        $this->assertTrue($this->maklerProduct->isMaklerListing());
        $this->assertFalse($this->maklerProduct->isOwnerListing());

        $this->assertFalse($this->ownerProduct->isMaklerListing());
        $this->assertTrue($this->ownerProduct->isOwnerListing());

        // Guest check
        $this->assertTrue($this->maklerProduct->canViewPhone(null));
        $this->assertFalse($this->ownerProduct->canViewPhone(null));

        // Authenticated user check
        $this->assertTrue($this->ownerProduct->canViewPhone($this->regularViewer));

        // Masked phone format
        $this->assertEquals('+998 90 *** ** **', $this->ownerProduct->masked_phone);
    }
}
