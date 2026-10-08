<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_renders_successfully(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Biz bilan bog\'laning', false);
        $response->assertSee('+998 (90) 306 64-46');
        $response->assertSee('+998 (95) 160 64-46');
        $response->assertSee('Telegram Kanal');
        $response->assertSee('Instagram');
        $response->assertSee('contactOfficeMap');
        $response->assertSee('info@estora.uz');
    }

    public function test_contact_page_form_submits_successfully(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Sardorbek',
            'phone' => '+998901234567',
            'subject' => 'Maslahat olish va mulk qidirish',
            'message' => 'Salom, yangi xonadonlar bo\'yicha maslahat olmoqchi edim.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('contact_success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Sardorbek',
            'phone' => '+998901234567',
            'status' => 'new',
        ]);
    }

    public function test_contact_page_ajax_submission_returns_json(): void
    {
        $response = $this->postJson('/contact', [
            'name' => 'Dilshod',
            'phone' => '+998939876543',
            'subject' => 'E\'lon joylashtirish bo\'yicha yordam',
            'message' => 'E\'lon rasmlarini yuklashda yordam bera olasizmi?',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Dilshod',
            'phone' => '+998939876543',
        ]);
    }

    public function test_contact_submission_requires_phone(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Test User',
            'message' => 'Telefon raqamsiz xabar yuborish',
        ]);

        $response->assertSessionHasErrors('phone');
    }
}
