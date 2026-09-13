<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Telegram Gateway API Configuration
    |--------------------------------------------------------------------------
    |
    | Telegram Gateway allows sending verification messages directly to users
    | on Telegram using their phone number.
    | See: https://gateway.telegram.org/
    |
    */

    'api_token' => env('TELEGRAM_GATEWAY_TOKEN', ''),
    'base_url' => env('TELEGRAM_GATEWAY_URL', 'https://gatewayapi.telegram.org'),
    'sender_username' => env('TELEGRAM_GATEWAY_SENDER', null),
    'mock_mode' => env('TELEGRAM_GATEWAY_MOCK', false),
    'code_length' => 5,
    'code_ttl_seconds' => 120, // 2 daqiqa amal qilish muddati
    'resend_cooldown_seconds' => 120, // 2 daqiqa qayta yuborish kutish vaqti
];
