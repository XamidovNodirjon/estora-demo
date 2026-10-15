<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Region;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class CabinetPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();
    }

    protected function makeMakler(array $attributes = []): User
    {
        $role = Role::firstOrCreate(['name' => 'makler']);

        return User::create(array_merge([
            'first_name' => 'Otabek',
            'last_name' => 'Qodirjonov',
            'name' => 'Qodirjonov Otabek',
            'username' => 'otabek_' . uniqid(),
            'phone' => '+99890' . random_int(1000000, 9999999),
            'password' => bcrypt('secret'),
            'role_id' => $role->id,
            'type' => 'makler',
        ], $attributes));
    }

    protected function makeProduct(User $owner, array $attributes = []): Product
    {
        $category = Category::firstOrCreate(['name' => 'Sotuv']);
        $subCategory = SubCategory::firstOrCreate(['category_id' => $category->id, 'name' => 'Kvartira']);
        $region = Region::firstOrCreate(['name' => 'Toshkent'], ['lat' => 41.31, 'long' => 69.24]);
        $city = City::firstOrCreate(['region_id' => $region->id, 'name' => 'Chilonzor'], ['lat' => 41.31, 'long' => 69.24]);

        return Product::create(array_merge([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'subcategory_id' => $subCategory->id,
            'region_id' => $region->id,
            'city_id' => $city->id,
            'name' => 'Limonaria village ' . uniqid(),
            'price' => 50000,
            'square' => 45,
            'rooms' => 2,
            'floor' => 5,
            'building_floor' => 7,
            'repair' => 'Yevro',
            'status' => 'active',
        ], $attributes));
    }

    public function test_home_shows_profile_card_quick_cards_and_balance(): void
    {
        $user = $this->makeMakler();
        $this->makeProduct($user, ['name' => 'Birinchi uy']);

        $this->actingAs($user)->get(route('client.dashboard'))
            ->assertOk()
            ->assertSee('ID: ' . (2000000 + $user->id))
            ->assertSee('Qodirjonov Otabek')
            ->assertSee("Aktiv rejimga o'ting", false)
            ->assertSee('Mening sahifam')
            ->assertSee('BALANS')
            ->assertSee("Verifikatsiyadan o'tilmagan", false)
            ->assertSee("Mening e'lonlarim", false)
            ->assertSee('Barchasi (1)')
            ->assertSee('Birinchi uy')
            ->assertSee('Bozor tahlili')
            ->assertSee('Tez orada')
            // Sayt footeri va yordam vidjeti
            ->assertSee('Ommaviy oferta')
            ->assertSee('Savollaringiz bormi?');
    }

    public function test_home_shows_empty_state_without_products(): void
    {
        $this->actingAs($this->makeMakler())->get(route('client.dashboard'))
            ->assertOk()
            ->assertSee("Hozir e'lonlaringiz mavjud emas!");
    }

    public function test_every_cabinet_section_renders(): void
    {
        $user = $this->makeMakler();
        $this->makeProduct($user);

        foreach (['my_products', 'chats', 'offers', 'favorites', 'news', 'account', 'settings', 'stats', 'subscription', 'my_page'] as $section) {
            $this->actingAs($user)
                ->get(route('client.dashboard', ['section' => $section]))
                ->assertOk();
        }
    }

    public function test_old_my_page_link_opens_account_form(): void
    {
        $this->actingAs($this->makeMakler())
            ->get(route('client.dashboard', ['section' => 'my_page']))
            ->assertOk()
            ->assertSee('passport-field', false);
    }

    public function test_tariffs_page_lists_plans(): void
    {
        $this->actingAs($this->makeMakler())
            ->get(route('client.dashboard', ['section' => 'subscription']))
            ->assertOk()
            ->assertSee('OYLIK')
            ->assertSee('YILLIK')
            ->assertSee('BASIC')
            ->assertSee('4 990')
            ->assertSee('9 990')
            ->assertSee('JORIY TARIF')
            ->assertSee('OBUNA OLISH');
    }

    public function test_favorites_section_lists_favorite_products(): void
    {
        $user = $this->makeMakler();
        $product = $this->makeProduct($this->makeMakler(), ['name' => 'Sevimli kvartira']);
        $user->favorites()->attach($product->id);

        $this->actingAs($user)
            ->get(route('client.dashboard', ['section' => 'favorites']))
            ->assertOk()
            ->assertSee('Sevimlilar (1)')
            ->assertSee('Sevimli kvartira');
    }

    public function test_public_page_shows_profile_and_listing_grid(): void
    {
        $user = $this->makeMakler();
        $this->makeProduct($user, ['name' => 'Ommaviy uy', 'is_top' => true]);

        $this->get(route('users.show', $user->username))
            ->assertOk()
            ->assertSee('Qodirjonov Otabek')
            ->assertSee('&#64;' . $user->username, false)
            ->assertSee("E'lonlar", false)
            ->assertSee('Ommaviy uy')
            ->assertSee('Kvartira Sotiladi')
            ->assertSee('50.000 y.e')
            ->assertSee('Kirish')
            ->assertDontSee('Mening kabinetim');
    }

    public function test_public_page_owner_sees_cabinet_link(): void
    {
        $user = $this->makeMakler();

        $this->actingAs($user)->get(route('users.show', $user->username))
            ->assertOk()
            ->assertSee('Mening kabinetim')
            ->assertSee('Chiqish');
    }

    public function test_public_page_search_and_pagination(): void
    {
        $user = $this->makeMakler();
        $this->makeProduct($user, ['name' => 'Qidiriladigan uy']);
        foreach (range(1, 9) as $i) {
            $this->makeProduct($user, ['name' => "Boshqa uy {$i}"]);
        }

        $this->get(route('users.show', ['user' => $user->username, 'q' => 'Qidiriladigan']))
            ->assertOk()
            ->assertSee('Qidiriladigan uy')
            ->assertDontSee('Boshqa uy 1');

        // 10 ta e'lon, sahifada 8 tadan
        $this->get(route('users.show', $user->username))
            ->assertOk()
            ->assertSee('page=2', false);
    }
}
