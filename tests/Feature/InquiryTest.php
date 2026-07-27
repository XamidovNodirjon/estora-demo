<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed roles
        $roles = ['admin', 'client', 'dev'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

    private function createAdminUser()
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

    private function createClientUser()
    {
        $clientRole = Role::where('name', 'client')->first();
        return User::create([
            'name' => 'Client User',
            'email' => 'client-' . uniqid() . '@example.com',
            'username' => 'client_' . uniqid(),
            'password' => bcrypt('password123'),
            'role_id' => $clientRole->id,
            'type' => 'client',
        ]);
    }

    public function test_public_user_can_submit_inquiry(): void
    {
        Inquiry::truncate();

        $response = $this->post('/inquiries', [
            'phone' => '+998901234567',
            'description' => 'Mening test savolim bor edi.'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success_inquiry');

        $this->assertDatabaseHas('inquiries', [
            'phone' => '+998901234567',
            'description' => 'Mening test savolim bor edi.',
            'status' => 'new'
        ]);
    }

    public function test_public_submission_requires_phone(): void
    {
        Inquiry::truncate();

        $response = $this->post('/inquiries', [
            'description' => 'Only description without phone.'
        ]);

        $response->assertSessionHasErrors('phone');
        $this->assertDatabaseEmpty('inquiries');
    }

    public function test_guest_cannot_access_admin_inquiries(): void
    {
        Inquiry::truncate();

        $inquiry = Inquiry::create([
            'phone' => '+998991112233',
            'description' => 'Sample question'
        ]);

        $this->get('/admin/inquiries')->assertRedirect('/login');
        $this->get("/admin/inquiries/{$inquiry->id}")->assertRedirect('/login');
        $this->put("/admin/inquiries/{$inquiry->id}", ['status' => 'completed'])->assertRedirect('/login');
    }

    public function test_client_cannot_access_admin_inquiries(): void
    {
        Inquiry::truncate();

        $client = $this->createClientUser();
        $inquiry = Inquiry::create([
            'phone' => '+998991112233',
            'description' => 'Sample question'
        ]);

        $this->actingAs($client);

        $this->get('/admin/inquiries')->assertStatus(403);
        $this->get("/admin/inquiries/{$inquiry->id}")->assertStatus(403);
        $this->put("/admin/inquiries/{$inquiry->id}", ['status' => 'completed'])->assertStatus(403);
    }

    public function test_admin_can_manage_inquiries(): void
    {
        Inquiry::truncate();

        $admin = $this->createAdminUser();
        $inquiry = Inquiry::create([
            'phone' => '+998991112233',
            'description' => 'Important admin query description'
        ]);

        $this->actingAs($admin);

        // 1. Index
        $indexResponse = $this->get('/admin/inquiries');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('+998991112233');
        $indexResponse->assertSee('Important admin query description');

        // 2. Show
        $showResponse = $this->get("/admin/inquiries/{$inquiry->id}");
        $showResponse->assertStatus(200);
        $showResponse->assertSee('+998991112233');
        $showResponse->assertSee('Important admin query description');

        // 3. Update status
        $updateResponse = $this->put("/admin/inquiries/{$inquiry->id}", [
            'status' => 'in_progress'
        ]);
        $updateResponse->assertRedirect(route('admin.inquiries.index'));
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'status' => 'in_progress'
        ]);
    }
}
