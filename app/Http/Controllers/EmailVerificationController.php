<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationCodeMail;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    /**
     * Send 6-digit verification code to the authenticated user's email.
     */
    public function sendCode(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        if (empty($user->email)) {
            return response()->json([
                'success' => false,
                'message' => 'Elektron pochtangiz kiritilmagan. Iltimos, profilingizda pochtangizni saqlang.'
            ], 422);
        }

        if ($user->email_verified_at) {
            return response()->json([
                'success' => true,
                'already_verified' => true,
                'message' => 'Elektron pochtangiz allaqachon tasdiqlangan.'
            ]);
        }

        // Generate 6-digit code
        $code = (string) random_int(100000, 999999);

        // Store in Cache for 15 minutes
        Cache::put('email_verification_code_' . $user->id, $code, now()->addMinutes(15));
        Cache::put('email_verification_email_' . $user->id, $user->email, now()->addMinutes(15));

        try {
            Mail::to($user->email)->send(new EmailVerificationCodeMail($code, $user->name ?? 'Foydalanuvchi'));
        } catch (\Throwable $e) {
            Log::error('Email verification send error: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Emailga xat jo\'natishda xatolik yuz berdi. Iltimos, pochtangiz to\'g\'riligini tekshiring.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => "Tasdiqlash kodi {$user->email} manziliga notifications@estora.uz orqali muvaffaqiyatli yuborildi."
        ]);
    }

    /**
     * Verify the 6-digit code.
     */
    public function verifyCode(Request $request): JsonResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6']
        ], [
            'code.required' => 'Tasdiqlash kodini kiriting.',
            'code.size' => 'Tasdiqlash kodi 6 xonali bo\'lishi kerak.'
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Foydalanuvchi tizimga kirmagan.'
            ], 401);
        }

        $cachedCode = Cache::get('email_verification_code_' . $user->id);

        if (!$cachedCode || $cachedCode !== trim($request->input('code'))) {
            return response()->json([
                'success' => false,
                'message' => 'Kiritilgan tasdiqlash kodi noto\'g\'ri yoki muddati tugagan (15 daqiqa).'
            ], 422);
        }

        // Mark user email as verified
        $user->email_verified_at = now();
        $user->save();

        // Clear cache
        Cache::forget('email_verification_code_' . $user->id);
        Cache::forget('email_verification_email_' . $user->id);

        $verificationStatus = app(ProductService::class)->getVerificationStatus($user);

        return response()->json([
            'success' => true,
            'message' => 'Elektron pochtangiz muvaffaqiyatli tasdiqlandi!',
            'verification' => $verificationStatus
        ]);
    }
}
