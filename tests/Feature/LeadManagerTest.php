<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Vite;
use Tests\TestCase;

class LeadManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Vite::spy();

        foreach (['dev', 'admin', 'manager', 'client'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    private function makeUser(string $role): User
    {
        return User::create([
            'name' => ucfirst($role) . ' User',
            'email' => $role . '-' . uniqid() . '@example.com',
            'username' => $role . '_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => Role::where('name', $role)->first()->id,
            'type' => $role,
        ]);
    }

    private function makeProduct(User $owner): Product
    {
        return Product::create([
            'user_id' => $owner->id,
            'name' => 'Uy ' . uniqid(),
            'price' => 50000,
            'description' => 'Test uy',
            'status' => 'active',
        ]);
    }

    public function test_admin_and_dev_can_open_leads_page(): void
    {
        $this->actingAs($this->makeUser('admin'))->get('/admin/leads')->assertOk();
        $this->actingAs($this->makeUser('dev'))->get('/developer/leads')->assertOk();
    }

    public function test_manager_and_client_cannot_manage_leads(): void
    {
        $this->actingAs($this->makeUser('manager'))->get('/admin/leads')->assertForbidden();
        $this->actingAs($this->makeUser('client'))->post('/admin/leads', [
            'name' => 'X', 'phone' => '+998901112233',
        ])->assertForbidden();

        $this->assertDatabaseMissing('leads', ['name' => 'X']);
    }

    public function test_admin_creates_lead_assigned_to_manager_via_polymorphic_pivot(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        $this->actingAs($admin)->post('/admin/leads', [
            'name' => 'Aziz Karimov',
            'phone' => '+998901234567',
            'description' => '2 xonali kvartira qidirmoqda',
            'manager_id' => $manager->id,
        ])->assertRedirect();

        $lead = Lead::firstOrFail();
        $this->assertSame('Aziz Karimov', $lead->name);
        $this->assertDatabaseHas('manager_assignments', [
            'manager_id' => $manager->id,
            'assignable_type' => 'lead',
            'assignable_id' => $lead->id,
            'assigned_by' => $admin->id,
        ]);
        $this->assertTrue($manager->assignedLeads()->whereKey($lead->id)->exists());

        $this->actingAs($admin)->get('/admin/leads?tab=assigned')
            ->assertOk()
            ->assertSee('Aziz Karimov')
            ->assertSee($manager->name);
    }

    public function test_store_redirects_to_tab_where_new_lead_lands(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        $this->actingAs($admin)->post('/admin/leads', ['name' => 'A', 'phone' => '+998900000001'])
            ->assertRedirect(route('admin.leads', ['tab' => 'new']));

        $this->actingAs($admin)->post('/admin/leads', ['name' => 'B', 'phone' => '+998900000002', 'manager_id' => $manager->id])
            ->assertRedirect(route('admin.leads', ['tab' => 'assigned']));
    }

    public function test_tabs_split_new_and_assigned_leads(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        Lead::create(['name' => 'Yangi Lid Alfa', 'phone' => '+998900000001']);
        $assigned = Lead::create(['name' => 'Berilgan Lid Beta', 'phone' => '+998900000002']);
        $assigned->managers()->attach($manager->id);

        $this->actingAs($admin)->get('/admin/leads')
            ->assertOk()
            ->assertSee('Yangi Lid Alfa')
            ->assertDontSee('Berilgan Lid Beta');

        $this->actingAs($admin)->get('/admin/leads?tab=assigned')
            ->assertOk()
            ->assertSee('Berilgan Lid Beta')
            ->assertDontSee('Yangi Lid Alfa');
    }

    public function test_admin_can_bulk_assign_up_to_ten_leads_to_manager(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        $ids = collect(range(1, 10))
            ->map(fn ($i) => Lead::create(['name' => "Lid {$i}", 'phone' => "+99890000000{$i}"])->id)
            ->all();

        $this->actingAs($admin)->post('/admin/leads/bulk-assign', [
            'lead_ids' => $ids,
            'manager_id' => $manager->id,
        ])->assertRedirect()->assertSessionHasNoErrors();

        $this->assertSame(10, $manager->assignedLeads()->count());
        $this->assertDatabaseHas('manager_assignments', [
            'manager_id' => $manager->id,
            'assignable_type' => 'lead',
            'assignable_id' => $ids[0],
            'assigned_by' => $admin->id,
        ]);
    }

    public function test_bulk_assign_rejects_more_than_ten_leads(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        $ids = collect(range(1, 11))
            ->map(fn ($i) => Lead::create(['name' => "Lid {$i}", 'phone' => "+9989000000{$i}"])->id)
            ->all();

        $this->actingAs($admin)->post('/admin/leads/bulk-assign', [
            'lead_ids' => $ids,
            'manager_id' => $manager->id,
        ])->assertSessionHasErrors('lead_ids');

        $this->assertSame(0, $manager->assignedLeads()->count());
    }

    private function assignedLead(User $manager, string $name = 'Status Lid'): Lead
    {
        $lead = Lead::create(['name' => $name, 'phone' => '+998900000001']);
        $lead->managers()->attach($manager->id);

        return $lead;
    }

    public function test_new_lead_has_new_status(): void
    {
        $lead = Lead::create(['name' => 'Lid', 'phone' => '+998900000001']);

        $this->assertSame(LeadStatus::New, $lead->fresh()->status);
    }

    public function test_manager_changes_status_with_comment_and_history_is_logged(): void
    {
        $manager = $this->makeUser('manager');
        $lead = $this->assignedLead($manager);

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'in_progress',
            'comment' => 'Qo\'ng\'iroq qildim, ertaga uy ko\'rishga boradi.',
        ])->assertRedirect()->assertSessionHasNoErrors();

        $this->assertSame(LeadStatus::InProgress, $lead->fresh()->status);
        $this->assertDatabaseHas('status_histories', [
            'statusable_type' => 'lead',
            'statusable_id' => $lead->id,
            'user_id' => $manager->id,
            'from_status' => 'new',
            'to_status' => 'in_progress',
        ]);
    }

    public function test_comment_is_required_when_status_changes(): void
    {
        $manager = $this->makeUser('manager');
        $lead = $this->assignedLead($manager);

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'agreed',
            'comment' => '   ',
        ])->assertSessionHasErrors('comment');

        $this->assertSame(LeadStatus::New, $lead->fresh()->status);
        $this->assertSame(0, $lead->statusHistories()->count());
    }

    public function test_rejection_requires_detailed_reason(): void
    {
        $manager = $this->makeUser('manager');
        $lead = $this->assignedLead($manager);

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'rejected',
            'comment' => 'Qimmat',
        ])->assertSessionHasErrors('comment');
        $this->assertSame(LeadStatus::New, $lead->fresh()->status);

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'rejected',
            'comment' => 'Mijoz narxni qimmat deb hisobladi, 50 000$ gacha variant qidiryapti.',
        ])->assertSessionHasNoErrors();
        $this->assertSame(LeadStatus::Rejected, $lead->fresh()->status);
    }

    public function test_status_change_rejects_same_or_unknown_status(): void
    {
        $manager = $this->makeUser('manager');
        $lead = $this->assignedLead($manager);

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'new',
            'comment' => 'Hech narsa o\'zgarmadi',
        ])->assertSessionHasErrors('status');

        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'archived',
            'comment' => 'Noma\'lum status',
        ])->assertSessionHasErrors('status');
    }

    public function test_only_assigned_manager_can_change_lead_status(): void
    {
        $owner = $this->makeUser('manager');
        $otherManager = $this->makeUser('manager');
        $admin = $this->makeUser('admin');
        $lead = $this->assignedLead($owner);

        $payload = ['status' => 'agreed', 'comment' => 'Kelishuvga erishildi, shartnoma tuziladi.'];

        $this->actingAs($otherManager)->put("/manager/leads/{$lead->id}/status", $payload)->assertForbidden();
        $this->actingAs($admin)->put("/manager/leads/{$lead->id}/status", $payload)->assertForbidden();

        $this->assertSame(LeadStatus::New, $lead->fresh()->status);
    }

    public function test_status_and_comments_are_visible_to_manager_and_admin(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');
        $lead = $this->assignedLead($manager, 'Nazorat Lidi');

        $reason = 'Mijoz boshqa tumandan uy sotib olishga qaror qildi.';
        $this->actingAs($manager)->put("/manager/leads/{$lead->id}/status", [
            'status' => 'rejected',
            'comment' => $reason,
        ]);

        $this->actingAs($manager)->get('/manager/leads?status=rejected')
            ->assertOk()
            ->assertSee('Nazorat Lidi')
            ->assertSee($reason);

        $this->actingAs($manager)->get('/manager/leads?status=agreed')
            ->assertOk()
            ->assertDontSee('Nazorat Lidi');

        $this->actingAs($admin)->get('/admin/leads?tab=assigned&status=rejected')
            ->assertOk()
            ->assertSee('Nazorat Lidi')
            ->assertSee($reason);

        $this->actingAs($manager)->get('/manager/dashboard')->assertOk();
    }

    public function test_bulk_assign_requires_manager_and_dev_can_use_it(): void
    {
        $dev = $this->makeUser('dev');
        $client = $this->makeUser('client');
        $manager = $this->makeUser('manager');
        $lead = Lead::create(['name' => 'Lid', 'phone' => '+998900000001']);

        $this->actingAs($dev)->post('/developer/leads/bulk-assign', [
            'lead_ids' => [$lead->id],
            'manager_id' => $client->id,
        ])->assertSessionHasErrors('manager_id');

        $this->actingAs($dev)->post('/developer/leads/bulk-assign', [
            'lead_ids' => [$lead->id],
            'manager_id' => $manager->id,
        ])->assertSessionHasNoErrors();

        $this->assertEquals([$manager->id], $lead->managers()->pluck('users.id')->all());
    }

    public function test_lead_cannot_be_assigned_to_non_manager(): void
    {
        $admin = $this->makeUser('admin');
        $client = $this->makeUser('client');

        $this->actingAs($admin)->post('/admin/leads', [
            'name' => 'Lid', 'phone' => '+998901234567', 'manager_id' => $client->id,
        ])->assertSessionHasErrors('manager_id');
    }

    public function test_dev_can_update_and_delete_lead(): void
    {
        $dev = $this->makeUser('dev');
        $managerA = $this->makeUser('manager');
        $managerB = $this->makeUser('manager');

        $this->actingAs($dev)->post('/developer/leads', [
            'name' => 'Lid', 'phone' => '+998901234567', 'manager_id' => $managerA->id,
        ]);
        $lead = Lead::firstOrFail();

        $this->actingAs($dev)->put("/developer/leads/{$lead->id}", [
            'name' => 'Lid yangilandi', 'phone' => '+998907654321', 'manager_id' => $managerB->id,
        ])->assertRedirect();

        $this->assertSame('Lid yangilandi', $lead->fresh()->name);
        $this->assertEquals([$managerB->id], $lead->managers()->pluck('users.id')->all());

        $this->actingAs($dev)->delete("/developer/leads/{$lead->id}")->assertRedirect();
        $this->assertDatabaseMissing('leads', ['id' => $lead->id]);
        $this->assertDatabaseMissing('manager_assignments', ['assignable_type' => 'lead', 'assignable_id' => $lead->id]);
    }

    public function test_manager_is_redirected_to_own_cabinet_and_sees_only_his_leads(): void
    {
        $manager = $this->makeUser('manager');
        $other = $this->makeUser('manager');

        $mine = Lead::create(['name' => 'Mening lidim', 'phone' => '+998900000001']);
        $theirs = Lead::create(['name' => 'Boshqa lid', 'phone' => '+998900000002']);
        $mine->managers()->attach($manager->id);
        $theirs->managers()->attach($other->id);

        $this->actingAs($manager)->get('/dashboard')->assertRedirect(route('manager.dashboard'));
        $this->actingAs($manager)->get('/manager/dashboard')->assertOk()->assertSee('Mening lidim');

        $this->actingAs($manager)->get('/manager/leads')
            ->assertOk()
            ->assertSee('Mening lidim')
            ->assertDontSee('Boshqa lid');
    }

    public function test_manager_cabinet_is_forbidden_for_clients(): void
    {
        $this->actingAs($this->makeUser('client'))->get('/manager/dashboard')->assertForbidden();
    }

    public function test_manager_can_update_profile(): void
    {
        $manager = $this->makeUser('manager');

        $this->actingAs($manager)->get('/manager/profile')->assertOk();
        $this->actingAs($manager)->put('/manager/profile', [
            'first_name' => 'Sardor',
            'last_name' => 'Aliyev',
            'phone' => '+998935554433',
        ])->assertRedirect(route('manager.profile'));

        $manager->refresh();
        $this->assertSame('Sardor', $manager->first_name);
        $this->assertSame('+998935554433', $manager->phone);
    }

    public function test_admin_assigns_product_and_manager_sees_assigned_and_own_products(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');

        $assigned = $this->makeProduct($admin);
        $notAssigned = $this->makeProduct($admin);
        $own = $this->makeProduct($manager);

        $this->actingAs($admin)->put("/admin/products/{$assigned->id}/managers", [
            'manager_ids' => [$manager->id],
        ])->assertRedirect();

        $this->assertDatabaseHas('manager_assignments', [
            'manager_id' => $manager->id,
            'assignable_type' => 'product',
            'assignable_id' => $assigned->id,
        ]);

        $this->actingAs($admin)->get('/admin/products')->assertOk()->assertSee($manager->name);
        $this->actingAs($this->makeUser('dev'))->get('/developer/products')->assertOk()->assertSee($manager->name);

        $this->actingAs($manager)->get('/manager/products')
            ->assertOk()
            ->assertSee($assigned->name)
            ->assertSee($own->name)
            ->assertDontSee($notAssigned->name);

        $this->actingAs($manager)->get('/manager/products?source=own')
            ->assertSee($own->name)
            ->assertDontSee($assigned->name);
    }

    public function test_manager_cannot_edit_or_delete_assigned_product(): void
    {
        $admin = $this->makeUser('admin');
        $manager = $this->makeUser('manager');
        $assigned = $this->makeProduct($admin);
        $assigned->managers()->attach($manager->id);

        $this->actingAs($manager)->get("/manager/products/{$assigned->id}/edit")->assertForbidden();
        $this->actingAs($manager)->delete("/manager/products/{$assigned->id}")->assertForbidden();
        $this->assertDatabaseHas('products', ['id' => $assigned->id]);
    }

    public function test_manager_can_open_create_form_and_delete_own_product(): void
    {
        $manager = $this->makeUser('manager');
        $own = $this->makeProduct($manager);

        $this->actingAs($manager)->get('/manager/products/create')->assertOk();
        $this->actingAs($manager)->get("/manager/products/{$own->id}/edit")->assertOk();

        $this->actingAs($manager)->delete("/manager/products/{$own->id}")
            ->assertRedirect(route('manager.products', ['source' => 'own']));
        $this->assertDatabaseMissing('products', ['id' => $own->id]);
    }
}
