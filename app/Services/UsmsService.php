<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class UsmsService
{
    protected string $login;
    protected string $secret;
    protected int    $templateId;
    protected string $from;
    protected string $baseUrl;
    protected bool   $isMock;

    public function __construct()
    {
        $this->login      = (string) config('usms.login', '');
        $this->secret     = (string) config('usms.secret', '');
        $this->templateId = (int)    config('usms.template_id', 0);
        $this->from       = (string) config('usms.from', '4546');
        $this->baseUrl    = (string) config('usms.base_url', 'https://usms.uz/api/v1/send');
        $this->isMock     = (bool)   config('usms.mock_mode', false)
                            || empty($this->login)
                            || empty($this->secret);
    }

    /**
     * Send a verification SMS code via USMS.uz API.
     *
     * @param  string $phone  Phone in E.164 format (+998901234567) or 998... format
     * @param  string $code   OTP code (e.g. "48219")
     * @return array{success: bool, message: string, mock_code?: string}
     */
    public function sendVerificationCode(string $phone, string $code): array
    {
        // Normalize phone: USMS expects 998XXXXXXXXX (12 digits, no '+')
        $normalizedPhone = $this->normalizePhone($phone);

        if ($this->isMock) {
            Log::info("[USMS Mock] Verification code sent to {$normalizedPhone}: {$code}");
            return [
                'success'   => true,
                'message'   => 'SMS kod yuborildi (Test rejimi).',
                'mock_code' => $code,
            ];
        }

        // Unique idempotency key per SMS send (as per USMS docs: unique per new message)
        $idempotencyKey = $this->buildIdempotencyKey();

        $payload = json_encode([
            'phone'       => $normalizedPhone,
            'template_id' => $this->templateId,
            'params'      => ['code' => $code],
            'from'        => $this->from,
            'idem_key'    => $idempotencyKey, // JSON body takes precedence over header (per USMS docs)
        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        $headers = [
            'Authorization: Bearer ' . $this->login . ':' . $this->secret,
            'Content-Type: application/json',
            'Idempotency-Key: ' . $idempotencyKey, // also send as header for older API versions
        ];

        $ch = curl_init($this->baseUrl);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => $payload,
        ]);

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            Log::error("[USMS] Transport error: {$curlError}");
            return [
                'success' => false,
                'message' => 'SMS xizmati bilan transport xatoligi yuz berdi.',
            ];
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            Log::error("[USMS] HTTP {$httpCode} to {$normalizedPhone}: {$response}");
            return [
                'success' => false,
                'message' => "SMS yuborib bo'lmadi (HTTP {$httpCode}). Keyinroq qayta urinib ko'ring.",
            ];
        }

        // Decode and log response
        try {
            $data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            Log::info("[USMS] SMS sent to {$normalizedPhone}. Response: " . json_encode($data));
        } catch (\JsonException $e) {
            Log::info("[USMS] SMS sent to {$normalizedPhone}. Raw: {$response}");
        }

        return [
            'success' => true,
            'message' => 'SMS kod muvaffaqiyatli yuborildi.',
        ];
    }

    /**
     * Normalize phone to USMS format: 998XXXXXXXXX (12 digits, no '+').
     */
    private function normalizePhone(string $phone): string
    {
        // Strip all non-digit characters
        $digits = preg_replace('/[^\d]/', '', $phone);

        // +998901234567 → 998901234567
        if (strlen($digits) === 12 && str_starts_with($digits, '998')) {
            return $digits;
        }

        // 901234567 (9 digits) → 998901234567
        if (strlen($digits) === 9) {
            return '998' . $digits;
        }

        // Already correct or unknown – return as-is
        return $digits;
    }

    /**
     * Build a unique idempotency key for each new SMS send.
     * Per USMS docs: "Har bir yangi SMS uchun noyob Idempotency-Key yarating".
     * On retry, reuse the same key — here we generate fresh per call since
     * the VerificationController handles retry throttling at a higher level.
     */
    private function buildIdempotencyKey(): string
    {
        return sprintf(
            '%s-%s',
            date('Ymd'),
            bin2hex(random_bytes(16))
        );
    }
}
