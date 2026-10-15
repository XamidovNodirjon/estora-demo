<?php

return [
    /*
    |--------------------------------------------------------------------------
    | USMS.uz API Configuration
    |--------------------------------------------------------------------------
    |
    | Uzbekistan SMS gateway (usms.uz) credentials and settings.
    | Used to send OTP verification codes to phone numbers during registration.
    |
    */

    'login'       => env('USMS_LOGIN', 'info@estora.uz'),
    'secret'      => env('USMS_SECRET', 'SMSTest2026'),
    'template_id' => (int) env('USMS_TEMPLATE_ID', 101),
    'from'        => env('USMS_FROM', '4546'),
    'base_url'    => env('USMS_BASE_URL', 'https://usms.uz/api/v1/send'),
    'balance_url' => env('USMS_BALANCE_URL', 'https://usms.uz/api/v1/balance'),

    /**
     * Mock mode: agar true bo'lsa haqiqiy SMS yuborilmaydi,
     * faqat logga yoziladi va mock_code qaytariladi.
     * Local development uchun true qiling.
     */
    'mock_mode' => env('USMS_MOCK', false),

    /**
     * OTP kodi necha soniya amal qiladi (TTL).
     * Cache va throttle ham shu qiymatga asoslanadi.
     */
    'code_ttl_seconds'        => 120, // 2 daqiqa
    'resend_cooldown_seconds' => 120, // 2 daqiqa qayta yuborish kutish vaqti

    /**
     * Parolni tiklash: login va yangi parol yuboriladigan SMS shabloni.
     * USMS kabinetida {username} va {password} parametrli shablon yaratilib,
     * uning ID si USMS_PASSWORD_RESET_TEMPLATE_ID ga yoziladi.
     * Masalan: "Estora: login: {username}, yangi parol: {password}"
     */
    'password_reset_template_id' => (int) env('USMS_PASSWORD_RESET_TEMPLATE_ID', 0),

    /**
     * Bitta raqam uchun parolni tiklash orasidagi kutish vaqti va kunlik limit
     * (begona odam boshqaning parolini qayta-qayta almashtira olmasligi uchun).
     */
    'password_reset_cooldown_seconds' => 300, // 5 daqiqa
    'password_reset_daily_limit'      => 3,
];
