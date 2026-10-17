<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class SubscriptionManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();
        Carbon::setTestNow('2026-10-16 10:00:00');
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function makeUser(string $role, array $attributes = []): User
    {
        $roleModel = Role::firstOrCreate(['name' => $role]);

        return User::create(array_merge([
            'first_name' => ucfirst($role),
            'last_name' => 'Test',
            'username' => $role . '_' . uniqid(),
            'phone' => '+99890' . random_int(1000000, 9999999),
            'password' => bcrypt('secret'),
            'role_id' => $roleModel->id,
            'type' => $role,
        ], $attributes));
    }

    private function subscriptionRequest(User $makler, string $plan = 'basic', string $period = 'monthly'): Inquiry
    {
        return Inquiry::create([
            'user_id' => $makler->id,
            'name' => $makler->name,
            'phone' => $makler->phone,
            'description' => 'BASIC tarifiga (oylik) obuna bo\'lmoqchiman.',
            'requested_plan' => $plan,
            'requested_period' => $period,
        ]);
    }

    public function test_new_user_is_on_free_plan(): void
    {
        $makler = $this->makeUser('makler');

        $this->assertSame('start', $makler->currentPlan());
        $this->assertFalse($makler->hasPaidPlan());
    }

    public function test_admin_activates_plan_from_inquiry_and_inquiry_is_completed(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');
        $inquiry = $this->subscriptionRequest($makler);

        $this->actingAs($admin)
            ->from(route('admin.inquiries.index'))
            ->post(route('admin.users.subscription', $makler), ['plan' => 'basic', 'period' => 'monthly', 'inquiry_id' => $inquiry->id])
            ->assertRedirect(route('admin.inquiries.index'))
            ->assertSessionHas('success');

        $makler->refresh();
        $this->assertSame('basic', $makler->currentPlan());
        $this->assertSame('2026-11-16', $makler->subscription_expires_at->toDateString());
        $this->assertSame('completed', $inquiry->fresh()->status);
    }

    public function test_dev_can_change_subscription_the_same_way(): void
    {
        $dev = $this->makeUser('dev');
        $makler = $this->makeUser('makler');

        $this->actingAs($dev)
            ->post(route('developer.users.subscription', $makler), ['plan' => 'plus', 'period' => 'yearly'])
            ->assertSessionHas('success');

        $makler->refresh();
        $this->assertSame('plus', $makler->currentPlan());
        $this->assertSame('2027-10-16', $makler->subscription_expires_at->toDateString());
    }

    public function test_extending_same_plan_adds_to_current_expiry(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');

        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'basic', 'period' => 'monthly']);
        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'basic', 'period' => 'monthly']);

        $this->assertSame('2026-12-16', $makler->fresh()->subscription_expires_at->toDateString());
    }

    public function test_switching_to_start_cancels_subscription(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');

        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'plus', 'period' => 'monthly']);
        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'start'])
            ->assertSessionHasNoErrors();

        $makler->refresh();
        $this->assertSame('start', $makler->currentPlan());
        $this->assertNull($makler->subscription_expires_at);
    }

    public function test_paid_plan_requires_period_and_valid_plan(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');

        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'basic'])
            ->assertSessionHasErrors('period');
        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'gold', 'period' => 'monthly'])
            ->assertSessionHasErrors('plan');

        $this->assertSame('start', $makler->fresh()->currentPlan());
    }

    public function test_expired_plan_falls_back_to_free(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');
        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'basic', 'period' => 'monthly']);

        Carbon::setTestNow('2026-12-01');
        $makler->refresh();

        $this->assertSame('start', $makler->currentPlan());
        $this->assertTrue($makler->subscriptionExpired());
    }

    public function test_cabinet_users_cannot_change_subscriptions(): void
    {
        $makler = $this->makeUser('makler');
        $other = $this->makeUser('makler');

        $this->actingAs($makler)->post(route('admin.users.subscription', $makler), ['plan' => 'plus', 'period' => 'yearly'])->assertForbidden();
        $this->actingAs($makler)->post(route('developer.users.subscription', $other), ['plan' => 'plus', 'period' => 'yearly'])->assertForbidden();

        $this->assertSame('start', $makler->fresh()->currentPlan());
    }

    public function test_subscription_fields_cannot_be_set_through_profile_mass_assignment(): void
    {
        $makler = $this->makeUser('makler', ['subscription_plan' => 'plus', 'subscription_expires_at' => now()->addYear()]);

        $this->assertSame('start', $makler->fresh()->currentPlan());
    }

    public function test_cabinet_subscription_request_is_linked_to_user_and_plan(): void
    {
        $makler = $this->makeUser('makler');

        $this->actingAs($makler)
            ->postJson(route('inquiries.store'), [
                'name' => $makler->name,
                'phone' => $makler->phone,
                'description' => 'PLUS tarifiga (yillik) obuna bo\'lmoqchiman.',
                'requested_plan' => 'plus',
                'requested_period' => 'yearly',
            ])->assertOk();

        $inquiry = Inquiry::latest('id')->first();
        $this->assertSame($makler->id, $inquiry->user_id);
        $this->assertSame('plus', $inquiry->requested_plan);
        $this->assertSame('yearly', $inquiry->requested_period);
    }

    public function test_guest_inquiry_is_not_a_subscription_request(): void
    {
        $this->postJson(route('inquiries.store'), ['phone' => '+998901112233', 'requested_plan' => 'plus'])->assertOk();

        $inquiry = Inquiry::latest('id')->first();
        $this->assertNull($inquiry->user_id);
        $this->assertNull($inquiry->requested_plan);
    }

    public function test_admin_inquiries_page_offers_quick_activation(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');
        $this->subscriptionRequest($makler);

        $this->actingAs($admin)->get(route('admin.inquiries.index', ['type' => 'subscription']))
            ->assertOk()
            ->assertSee("Obuna so'rovlari", false)
            ->assertSee('BASIC ni yoqish')
            ->assertSee(route('admin.users.subscription', $makler))
            ->assertSee('subscriptionModal');
    }

    public function test_dev_has_inquiries_page_with_same_controls(): void
    {
        $dev = $this->makeUser('dev');
        $makler = $this->makeUser('makler');
        $inquiry = $this->subscriptionRequest($makler, 'plus', 'yearly');

        $this->actingAs($dev)->get(route('developer.inquiries.index'))
            ->assertOk()
            ->assertSee('PLUS ni yoqish')
            ->assertSee(route('developer.users.subscription', $makler));

        $this->actingAs($dev)->get(route('developer.inquiries.show', $inquiry))
            ->assertOk()
            ->assertSee("Obuna so'rovi", false)
            ->assertSee(route('developer.inquiries.update', $inquiry));
    }

    public function test_admin_clients_tab_lists_maklers_with_subscription_column(): void
    {
        $admin = $this->makeUser('admin');
        // Lokal test bazasi MyISAM (tranzaksiyasiz): boshqa testlar yozuvlaridan keyin - ro'yxat boshida chiqsin
        Carbon::setTestNow('2031-01-01 10:00:00');
        $makler = $this->makeUser('makler');

        $this->actingAs($admin)->get(route('admin.users', ['tab' => 'clients']))
            ->assertOk()
            ->assertSee($makler->username)
            ->assertSee('Obuna')
            ->assertSee(route('admin.users.subscription', $makler));
    }

    public function test_dev_users_list_has_subscription_controls(): void
    {
        $dev = $this->makeUser('dev');
        // Lokal test bazasi MyISAM (tranzaksiyasiz): boshqa testlar yozuvlaridan keyin - ro'yxat boshida chiqsin
        Carbon::setTestNow('2031-01-01 10:00:00');
        $makler = $this->makeUser('makler');

        $this->actingAs($dev)->get(route('developer.users'))
            ->assertOk()
            ->assertSee(route('developer.users.subscription', $makler));
    }

    public function test_cabinet_shows_active_plan(): void
    {
        $admin = $this->makeUser('admin');
        $makler = $this->makeUser('makler');
        $this->actingAs($admin)->post(route('admin.users.subscription', $makler), ['plan' => 'basic', 'period' => 'monthly']);

        $this->actingAs($makler->fresh())->get(route('client.dashboard', ['section' => 'subscription']))
            ->assertOk()
            ->assertSee('Joriy tarif:')
            ->assertSee('16.11.2026 gacha')
            ->assertSee('JORIY TARIF &middot; UZAYTIRISH', false);

        $this->actingAs($makler->fresh())->get(route('client.dashboard'))
            ->assertOk()
            ->assertSee('Basic');
    }
}
