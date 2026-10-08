<?php

namespace App\Services;

use App\Models\Inquiry;

class ContactService
{
    /**
     * Get structured contact details, social links, departments, and FAQs.
     */
    public function getContactData(): array
    {
        return [
            'company' => [
                'name' => 'MCHJ "Estora Global"',
                'tagline' => "Ko'chmas mulkning yagona raqamli ekotizimi",
                'address' => "Toshkent shahri, Mirobod tumani, Amir Temur shoh ko'chasi, 107-B",
                'landmark' => '"Amir Temur xiyoboni" va "Yunus Rajabiy" metro bekatlari',
                'working_hours' => [
                    'office' => 'Dushanba – Shanba: 09:00 – 18:00',
                    'call_center' => '24/7 (Dam olish kunlarisiz, bepul)',
                ],
                'coords' => [
                    'lat' => 41.311081,
                    'lng' => 69.279737,
                ],
            ],
            'phones' => [
                [
                    'number' => '+998 (90) 306 64-46',
                    'raw' => '+998903066446',
                    'label' => 'Yagona Call-markaz (24/7)',
                    'desc' => "O'zbekiston bo'ylab qo'ng'iroq bepul",
                    'badge' => '24/7 Asosiy',
                    'is_primary' => true,
                    'icon' => 'fa-solid fa-headset',
                ],
                [
                    'number' => '+998 (95) 160 64-46',
                    'raw' => '+998951606446',
                    'label' => 'Mijozlarni qo\'llab-quvvatlash',
                    'desc' => 'Texnik savollar va maslahatlar',
                    'badge' => 'Support',
                    'is_primary' => false,
                    'icon' => 'fa-solid fa-phone-volume',
                ],
                [
                    'number' => '+998 (71) 200 64-46',
                    'raw' => '+998712006446',
                    'label' => 'Savdo va tijorat bo\'limi',
                    'desc' => 'Tijoriy e\'lonlar va investitsiyalar',
                    'badge' => 'Savdo',
                    'is_primary' => false,
                    'icon' => 'fa-solid fa-building',
                ],
                [
                    'number' => '+998 (90) 123 64-46',
                    'raw' => '+998901236446',
                    'label' => 'Hamkorlik va rieltorlar',
                    'desc' => 'Qurilish kompaniyalari va agentlar',
                    'badge' => 'B2B',
                    'is_primary' => false,
                    'icon' => 'fa-solid fa-handshake',
                ],
            ],
            'emails' => [
                [
                    'address' => 'info@estora.uz',
                    'label' => 'Umumiy ma\'lumotlar',
                    'desc' => 'Rasmiy xatlar va takliflar uchun',
                    'icon' => 'fa-regular fa-envelope',
                ],
                [
                    'address' => 'support@estora.uz',
                    'label' => 'Mijozlar ko\'magi',
                    'desc' => 'Texnik yordam va e\'lonlar masalasi',
                    'icon' => 'fa-solid fa-envelope-open-text',
                ],
                [
                    'address' => 'partner@estora.uz',
                    'label' => 'B2B Hamkorlik',
                    'desc' => 'Tijoriy va investitsion loyihalar',
                    'icon' => 'fa-solid fa-briefcase',
                ],
            ],
            'socials' => [
                [
                    'name' => 'Telegram Kanal',
                    'username' => '@estora_uz',
                    'url' => 'https://t.me/estora_uz',
                    'icon' => 'fab fa-telegram-plane',
                    'brand_color' => '#229ED9',
                    'description' => 'Eng so\'nggi e\'lonlar, yangiliklar va qulay takliflar',
                    'badge' => 'Kanal',
                ],
                [
                    'name' => 'Telegram Yordamchi Bot',
                    'username' => '@estora_support_bot',
                    'url' => 'https://t.me/estora_support_bot',
                    'icon' => 'fas fa-robot',
                    'brand_color' => '#0088cc',
                    'description' => '24/7 onlayn konsultatsiya va tezkor murojaat qoldirish',
                    'badge' => 'Bot',
                ],
                [
                    'name' => 'Instagram',
                    'username' => '@estora_uz',
                    'url' => 'https://instagram.com/estora_uz',
                    'icon' => 'fab fa-instagram',
                    'brand_color' => '#E1306C',
                    'description' => 'Foto va video sharhlar, elit xonadonlar va ob-havo',
                    'badge' => 'Stories & Reels',
                ],
                [
                    'name' => 'Facebook',
                    'username' => 'estora.uz',
                    'url' => 'https://facebook.com/estora_uz',
                    'icon' => 'fab fa-facebook-f',
                    'brand_color' => '#1877F2',
                    'description' => 'Bozor tahlili, rasmiy yangiliklar va intervyular',
                    'badge' => 'Sahifa',
                ],
                [
                    'name' => 'YouTube',
                    'username' => '@estora_uz',
                    'url' => 'https://youtube.com/@estora_uz',
                    'icon' => 'fab fa-youtube',
                    'brand_color' => '#FF0000',
                    'description' => 'Video turlar, yangi turar-joy majmualari taqdimoti',
                    'badge' => 'Video turlar',
                ],
                [
                    'name' => 'X (Twitter)',
                    'username' => '@estora_uz',
                    'url' => 'https://x.com/estora_uz',
                    'icon' => 'fab fa-x-twitter',
                    'brand_color' => '#0f172a',
                    'description' => 'Qisqa yangiliklar, dayjestlar va ko\'chmas mulk statistikasi',
                    'badge' => 'Microblog',
                ],
            ],
            'departments' => [
                'Maslahat olish va mulk qidirish',
                'E\'lon joylashtirish bo\'yicha yordam',
                'Quruvchilar va B2B hamkorlik',
                'Rieltorlar va agentliklar bilan ishlash',
                'Taklif yoki texnik xatolik',
            ],
            'faqs' => [
                [
                    'q' => 'Call-markazga qo\'ng\'iroq qilish bepulmi?',
                    'a' => 'Ha, O\'zbekiston bo\'ylab barcha mobil operatorlar (Ucell, Mobiuz, Beeline, UzMobile) va shahar telefonlaridan yagona raqamimizga qo\'ng\'iroq qilish mutlaqo bepul.',
                ],
                [
                    'q' => 'Onlayn murojaatim qancha vaqt ichida ko\'rib chiqiladi?',
                    'a' => 'Sayt orqali qoldirilgan barcha arizalar call-markaz mutaxassislarimizga darhol yuboriladi va ish vaqtida 10-15 daqiqa ichida siz bilan bog\'lanishadi.',
                ],
                [
                    'q' => 'E\'lon joylashtirishda mutaxassis yordam bera oladimi?',
                    'a' => 'Albatta! Agar e\'lon qo\'shishda rasm yuklash yoki parametrlar tanlashda savollaringiz bo\'lsa, bizning mutaxassislarimiz telefon yoki Telegram orqali barcha ma\'lumotlarni kiritishda bepul ko\'maklashadi.',
                ],
                [
                    'q' => 'Bosh ofisga tashrif buyurish tartibi qanday?',
                    'a' => 'Bizning bosh ofisimiz dushanbadan shanbagacha soat 09:00 dan 18:00 gacha ochiq. Oldindan yozilish majburiy emas, qabul xodimlari sizni mamnuniyat bilan kutib olishadi.',
                ],
            ],
        ];
    }

    /**
     * Create inquiry from contact form data.
     */
    public function createInquiry(array $data): Inquiry
    {
        $subject = !empty($data['subject']) ? trim($data['subject']) : null;
        $message = !empty($data['message']) ? trim($data['message']) : '';

        $fullDescription = $subject
            ? "Mavzu: {$subject}\n\n{$message}"
            : $message;

        return Inquiry::create([
            'name' => $data['name'] ?? null,
            'phone' => $data['phone'],
            'description' => trim($fullDescription) ?: null,
            'status' => 'new',
        ]);
    }
}
