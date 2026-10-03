<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendSmsJob;
use App\Models\SmsNotification;
use App\Models\User;
use App\Services\UsmsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    protected UsmsService $smsService;

    public function __construct(UsmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Format raw phone to standardized E.164 format (+998...)
     */
    public static function formatPhone(string $rawPhone): string
    {
        $digits = preg_replace('/[^\d]/', '', $rawPhone);
        if (strlen($digits) === 9) {
            return '+998' . $digits;
        }
        if (strlen($digits) === 12 && str_starts_with($digits, '998')) {
            return '+' . $digits;
        }
        return '+' . ltrim($digits, '+');
    }

    /**
     * Check existing active verification status for phone.
     * Foydalanuvchi sahifani refresh qilsa yoki qayta kirsa,
     * mavjud 2 daqiqalik sessiya bor-yo'qligini tekshirish uchun.
     */
    public function checkStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:7|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false], 422);
        }

        $formattedPhone = self::formatPhone($request->input('phone'));
        $cacheKey       = 'verify_code_' . md5($formattedPhone);
        $throttleKey    = 'verify_throttle_' . md5($formattedPhone);

        $data            = Cache::get($cacheKey);
        $throttleExpires = Cache::get($throttleKey);

        if ($data && isset($data['expires_at']) && $data['expires_at'] > time()) {
            $remaining  = $data['expires_at'] - time();
            $retryAfter = $throttleExpires ? max(0, $throttleExpires - time()) : 0;

            return response()->json([
                'success'           => true,
                'has_active_code'   => true,
                'remaining_seconds' => $remaining,
                'retry_after'       => $retryAfter,
                'phone'             => $formattedPhone,
            ]);
        }

        return response()->json([
            'success'         => true,
            'has_active_code' => false,
        ]);
    }

    /**
     * Send verification code via USMS.uz SMS Gateway.
     * Agar 2 minut ichida kod yuborilgan bo'lsa, qayta yuborilmaydi (mavjud vaqt davom etadi).
     */
    public function sendCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:7|max:20',
            'force' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Telefon raqam noto'g'ri kiritildi.",
                'errors'  => $validator->errors(),
            ], 422);
        }

        $formattedPhone = self::formatPhone($request->input('phone'));

        // Check if phone already registered (agar foydalanuvchi tizimga kirgan bo'lsa, o'zining raqami bundan mustasno)
        $existingUser = User::where('phone', $formattedPhone)->first();
        if ($existingUser && (!auth()->check() || $existingUser->id !== auth()->id())) {
            return response()->json([
                'success' => false,
                'message' => "Bu telefon raqam allaqachon boshqa foydalanuvchi tomonidan ro'yxatdan o'tkazilgan.",
            ], 422);
        }

        $cacheKey    = 'verify_code_' . md5($formattedPhone);
        $throttleKey = 'verify_throttle_' . md5($formattedPhone);
        $force       = (bool) $request->input('force', false);

        // Agar avval kod yuborilgan bo'lsa va hali 2 minut o'tmagan bo'lsa:
        $existing = Cache::get($cacheKey);
        if (!$force && $existing && isset($existing['expires_at']) && $existing['expires_at'] > time()) {
            $remaining    = $existing['expires_at'] - time();
            $throttleTime = Cache::get($throttleKey);
            $retryAfter   = $throttleTime ? max(0, $throttleTime - time()) : 0;

            $resp = [
                'success'           => true,
                'already_sent'      => true,
                'message'           => 'Ushbu raqamga SMS orqali tasdiqlash kodi allaqachon yuborilgan.',
                'phone'             => $formattedPhone,
                'remaining_seconds' => $remaining,
                'retry_after'       => $retryAfter,
            ];

            if (isset($existing['mock_code'])) {
                $resp['mock_code'] = $existing['mock_code'];
            }

            return response()->json($resp);
        }

        // Rate limit: 2 minut (120 soniya) cooldown agar force yoki yangi so'rov bo'lsa
        if (Cache::has($throttleKey)) {
            $remaining = Cache::get($throttleKey) - time();
            if ($remaining > 0) {
                return response()->json([
                    'success'     => false,
                    'message'     => "Iltimos, qayta kod yuborish uchun {$remaining} soniya kuting.",
                    'retry_after' => $remaining,
                ], 429);
            }
        }

        // Generate 5-digit code
        $code = (string) random_int(10000, 99999);
        $ttl  = (int) config('usms.code_ttl_seconds', 120);
        $isMock = (bool) config('usms.mock_mode', false)
            || empty(config('usms.login'))
            || empty(config('usms.secret'));

        // SMS yozuvini yaratish (kutilmoqda holatida)
        $smsRecord = SmsNotification::create([
            'phone'   => $formattedPhone,
            'code'    => $code,
            'message' => "Tasdiqlash kodi: {$code}",
            'status'  => 'pending',
        ]);

        // Send via Queue Job (tizim qotib qolmasligi uchun navbat bilan yuboriladi)
        SendSmsJob::dispatch($formattedPhone, $code, $smsRecord->id);

        // Store code hash in Cache for 2 minutes (120 soniya)
        $cacheData = [
            'hash'       => Hash::make($code),
            'plain'      => $code,
            'expires_at' => time() + $ttl,
            'attempts'   => 0,
        ];
        if ($isMock) {
            $cacheData['mock_code'] = $code;
        }
        Cache::put($cacheKey, $cacheData, $ttl);
        \Illuminate\Support\Facades\Log::info("[OTP SEND] Code queued for {$formattedPhone}: {$code}");

        // Set cooldown timer for 2 minutes
        $cooldown = (int) config('usms.resend_cooldown_seconds', 120);
        Cache::put($throttleKey, time() + $cooldown, $cooldown);

        $response = [
            'success'           => true,
            'already_sent'      => false,
            'message'           => 'Tasdiqlash SMS kodi navbatga qo\'yildi va yuborilmoqda.',
            'phone'             => $formattedPhone,
            'remaining_seconds' => $ttl,
            'retry_after'       => $cooldown,
        ];

        // Test (mock) rejimida bo'lsa, ishlab chiquvchiga qulaylik uchun kodni ko'rsatish
        if ($isMock) {
            $response['mock_code'] = $code;
            $response['message']  .= ' (Test kodi: ' . $code . ')';
        }

        return response()->json($response);
    }

    /**
     * Verify the code submitted by user.
     */
    public function verifyCode(Request $request): JsonResponse
    {
        // Sanitize code: remove non-digits, trim spaces
        $rawCode   = (string) $request->input('code', '');
        $inputCode = preg_replace('/[^\d]/', '', trim($rawCode));

        $validator = Validator::make([
            'phone' => $request->input('phone'),
            'code'  => $inputCode,
        ], [
            'phone' => 'required|string',
            'code'  => 'required|string|min:4|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Tasdiqlash kodini to'liq kiriting (raqamlardan iborat).",
            ], 422);
        }

        $formattedPhone = self::formatPhone($request->input('phone'));

        $cacheKey = 'verify_code_' . md5($formattedPhone);
        $data     = Cache::get($cacheKey);

        \Illuminate\Support\Facades\Log::info("[OTP VERIFY] Attempt for {$formattedPhone}: entered={$inputCode}, has_cache=" . ($data ? 'YES' : 'NO'));

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => "Tasdiqlash kodining muddati (2 daqiqa) tugagan yoki yangi kod so'ralmagan.",
            ], 400);
        }

        // Urinishlar sonini cheklash (maksimal 5 ta urinish)
        if (($data['attempts'] ?? 0) >= 5) {
            Cache::forget($cacheKey);
            return response()->json([
                'success' => false,
                'message' => "Urinishlar soni oshib ketdi. Iltimos, qaytadan yangi kod so'rang.",
            ], 429);
        }

        $hashMatch  = isset($data['hash']) && Hash::check($inputCode, $data['hash']);
        $plainMatch = isset($data['plain']) && hash_equals((string)$data['plain'], (string)$inputCode);
        $mockMatch  = isset($data['mock_code']) && hash_equals((string)$data['mock_code'], (string)$inputCode);

        if (!$hashMatch && !$plainMatch && !$mockMatch) {
            $data['attempts'] = ($data['attempts'] ?? 0) + 1;
            Cache::put($cacheKey, $data, max(1, $data['expires_at'] - time()));

            $left = 5 - $data['attempts'];
            \Illuminate\Support\Facades\Log::warning("[OTP VERIFY] Mismatch for {$formattedPhone}: entered={$inputCode}, expected=" . ($data['plain'] ?? 'N/A'));
            return response()->json([
                'success' => false,
                'message' => "Noto'g'ri kod kiritildi. Qolgan urinishlar: {$left}.",
            ], 422);
        }

        // Muvaffaqiyatli tasdiqlandi
        Cache::forget($cacheKey);
        \Illuminate\Support\Facades\Log::info("[OTP VERIFY] Success for {$formattedPhone}");

        // Session va Cache ga telefon raqam tasdiqlanganini saqlaymiz (15 daqiqaga)
        $verifiedToken   = bin2hex(random_bytes(16));
        $verifySessionKey = 'verified_phone_' . md5($formattedPhone);
        Cache::put($verifySessionKey, $verifiedToken, 900);
        session()->put('verified_phone', $formattedPhone);
        session()->put('verified_token', $verifiedToken);

        // Agar foydalanuvchi tizimga kirgan bo'lsa (masalan Google orqali kirgan va telefonini tasdiqlayotgan bo'lsa):
        if (auth()->check()) {
            $user = auth()->user();
            $user->phone = $formattedPhone;
            $user->phone_verified_at = now();
            $user->save();
        }

        $verificationStatus = auth()->check() ? app(\App\Services\ProductService::class)->getVerificationStatus(auth()->user()) : null;

        return response()->json([
            'success'        => true,
            'message'        => 'Telefon raqam muvaffaqiyatli tasdiqlandi!',
            'verified_token' => $verifiedToken,
            'phone'          => $formattedPhone,
            'verification'   => $verificationStatus,
        ]);
    }
}
