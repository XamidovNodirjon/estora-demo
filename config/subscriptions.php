<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Obuna tariflari
    |--------------------------------------------------------------------------
    |
    | Kabinetdagi "Tariflar" sahifasi, admin va dev panellar shu ro'yxatdan
    | foydalanadi. "start" - bepul (standart) tarif, muddati bo'lmaydi.
    | Yillik narx = oylik * 12 * (1 - yearly_discount).
    |
    */

    'default' => 'start',

    // Obuna qaysi rollar uchun (kabinet foydalanuvchilari; xodimlar uchun emas)
    'roles' => ['client', 'makler', 'owner', 'hotel', 'builder'],

    'yearly_discount' => 0.5,

    'periods' => [
        'monthly' => ['label' => 'Oylik', 'months' => 1],
        'yearly' => ['label' => 'Yillik', 'months' => 12],
    ],

    'plans' => [
        'start' => [
            'name' => 'START',
            'badge' => 'Free',
            'monthly' => 0,
            'subtitle' => 'Talabalar va asosiy uy-joy ehtiyojlari uchun.',
            'features' => [
                "Xonadosh qidirish va e'lon joylashtirish",
                "Uy-joy e'lonlarini ko'rish",
                'Vositachili va vositachisiz uylarni qidirish',
                "To'liq qidiruv va filtr imkoniyatlari",
                'Xarita orqali qidirish',
                "Uy egasi yoki boshqa foydalanuvchi bilan to'g'ridan-to'g'ri aloqa",
                "E'lon bo'yicha asosiy ma'lumotlarni ko'rish",
            ],
        ],
        'basic' => [
            'name' => 'BASIC',
            'badge' => 'Basic',
            'monthly' => 4990,
            'featured' => true,
            'subtitle' => 'Kengaytirilgan uy-joy qidiruvi va boshqaruvi.',
            'features' => [
                'FREE tarifidagi barcha imkoniyatlar +',
                "10 tagacha aktiv e'lon",
                "Metro va universitetlar atrofida yoki istalgan nuqta belgilagan holda radius bo'yicha uy qidirish",
                "Tekshiruvdan o'tgan ishonchli maklerlar",
                '3D va video tur',
                "Bozor narxini avtomatik baholash, narx bo'yicha bepul tavsiyalar",
                'Uy bron qilish',
                'Narx taklifi yuborish',
                'ESTORA AI Agent (cheklangan)',
            ],
        ],
        'plus' => [
            'name' => 'PLUS',
            'badge' => 'Plus',
            'monthly' => 9990,
            'subtitle' => "Ko'chmas mulk va investitsiyalar uchun kengaytirilgan imkoniyatlar",
            'features' => [
                'BASIC tarifidagi barcha imkoniyatlar +',
                "ESTORA AI Agent (to'liq boshqaruv)",
                "To'liq bozor tahlili",
                'Investitsiya indeksi',
                "Daromadlilik va ishonchlilik ko'rsatkichlari",
                'Ijara va sotuv daromadlari statistikasi',
                'Investitsiya uchun obyektlarni AI orqali tahlil qilish',
                'Bepul mutaxassis maslahatlari',
                'Uy qiymati va bozor istiqboli tahlili',
                'Auksion orqali savdo',
            ],
        ],
    ],
];
