<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramGatewayService
{
    protected string $apiToken;
    protected string $baseUrl;
    protected bool $isMock;
    protected ?string $senderUsername;

    public function __construct()
    {
        $this->apiToken = (string) config('telegram.api_token', '');
        $this->baseUrl = rtrim((string) config('telegram.base_url', 'https://gatewayapi.telegram.org'), '/');
        $this->isMock = (bool) config('telegram.mock_mode', false) || empty($this->apiToken);
        $this->senderUsername = config('telegram.sender_username');
    }

    /**
     * Send verification code to user via Telegram Gateway API.
     *
     * @param string $phone Phone in E.164 format (e.g. +998901234567)
     * @param string $code Verification code (5 digits)
     * @return array ['success' => bool, 'message' => string, 'request_id' => ?string]
     */
    public function sendVerificationCode(string $phone, string $code): array
    {
        // Agar mock rejim bo'lsa yoki token yo'q bo'lsa, logga yozib muvaffaqiyatli deb hisoblaymiz
        if ($this->isMock) {
            Log::info("[TelegramGateway Mock] Verification code sent to {$phone}: {$code}");
            return [
                'success' => true,
                'message' => 'Tasdiqlovchi kod Telegram orqali yuborildi (Test rejimi).',
                'request_id' => 'mock_' . uniqid(),
                'mock_code' => $code, // Local test uchun qulaylik
            ];
        }

        try {
            $payload = [
                'phone_number' => $phone,
                'code' => $code,
                'code_length' => strlen($code),
                'ttl' => (int) config('telegram.code_ttl_seconds', 300),
            ];

            if ($this->senderUsername) {
                $payload['sender_username'] = $this->senderUsername;
            }

            $response = Http::withToken($this->apiToken)
                ->timeout(10)
                ->post("{$this->baseUrl}/sendVerificationMessage", $payload);

            $data = $response->json();

            if ($response->successful() && ($data['ok'] ?? false)) {
                return [
                    'success' => true,
                    'message' => 'Tasdiqlovchi kod Telegram orqali yuborildi.',
                    'request_id' => $data['result']['request_id'] ?? null,
                ];
            }

            $errorMsg = $data['error'] ?? ($data['description'] ?? 'Telegram Gateway orqali xabar yuborib bo\'lmadi');
            Log::error("[TelegramGateway Error] " . json_encode($data));

            return [
                'success' => false,
                'message' => $errorMsg,
                'request_id' => null,
            ];
        } catch (\Throwable $e) {
            Log::error("[TelegramGateway Exception] " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Telegram xizmati bilan ulanishda xatolik yuz berdi.',
                'request_id' => null,
            ];
        }
    }
}
