<?php

namespace App\Services;

use App\Http\Controllers\Auth\VerificationController;
use App\Jobs\SendSmsJob;
use App\Mail\PasswordResetCodeMail;
use App\Models\SmsNotification;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Parolni tiklash (3 bosqich):
 *  1. Foydalanuvchi username yoki telefon raqam orqali topiladi va tasdiqlash kodi yuboriladi:
 *     - username bo'yicha: email bo'lsa emailga, bo'lmasa telefon raqamga (SMS);
 *     - telefon bo'yicha: SMS orqali.
 *  2. Kod tasdiqlanadi va foydalanuvchining username'i qaytariladi.
 *  3. Foydalanuvchi yangi parol (xohlasa yangi username) o'rnatadi.
 *
 * Jarayon holati sessiyada, kod esa (hash ko'rinishida) cache'da saqlanadi.
 */
class PasswordResetService
{
    public const SESSION_KEY = 'password_reset';

    private const CODE_PREFIX = 'password_reset_code_';
    private const COOLDOWN_PREFIX = 'password_reset_cooldown_';
    private const DAILY_PREFIX = 'password_reset_daily_';
    private const MAX_ATTEMPTS = 5;
    private const VERIFIED_TTL = 900; // kod tasdiqlangandan keyin parolni yangilash uchun 15 daqiqa

    public function __construct(
        protected UserRepository $userRepository,
        protected AuthService $authService,
        protected UsmsService $smsService
    ) {}

    /**
     * @param  'username'|'phone' $method
     * @return array{channel: string, destination: string, expires_in: int, retry_after: int, mock_code?: string}
     */
    public function sendCode(string $method, string $value): array
    {
        $user = $method === 'username'
            ? $this->findByUsername($value)
            : $this->findByPhone($value);

        $channel = $method === 'username' && filled($user->email) ? 'email' : 'sms';

        if ($channel === 'sms' && blank($user->phone)) {
            throw ValidationException::withMessages([
                $method => "Hisobingizga email ham, telefon raqam ham bog'lanmagan. Iltimos, administrator bilan bog'laning.",
            ]);
        }

        $this->ensureNotThrottled($user, $method);

        $code = (string) random_int(100000, 999999);
        $ttl = (int) config('usms.password_reset_code_ttl_seconds', 300);

        $channel === 'email'
            ? $this->sendEmail($user, $code, $ttl, $method)
            : $this->sendSms($user, $code);

        Cache::put(self::CODE_PREFIX . $user->id, [
            'hash' => Hash::make($code),
            'attempts' => 0,
            'expires_at' => time() + $ttl,
        ], $ttl);

        session()->put(self::SESSION_KEY, [
            'user_id' => $user->id,
            'channel' => $channel,
            'verified_until' => null,
        ]);

        $retryAfter = $this->hitThrottle($user);

        Log::info("[PASSWORD RESET] Code sent to user #{$user->id} via {$channel}");

        $result = [
            'channel' => $channel,
            'destination' => $channel === 'email' ? $this->maskEmail($user->email) : $this->maskPhone($user->phone),
            'expires_in' => $ttl,
            'retry_after' => $retryAfter,
        ];

        // Test rejimida haqiqiy xabar ketmaydi - kodni ekranda ko'rsatamiz
        if ($this->isMockChannel($channel)) {
            $result['mock_code'] = $code;
        }

        return $result;
    }

    /**
     * @return array{username: string}
     */
    public function verifyCode(string $code): array
    {
        $user = $this->pendingUser();
        $cacheKey = self::CODE_PREFIX . $user->id;
        $data = Cache::get($cacheKey);

        if (!$data || $data['expires_at'] <= time()) {
            throw ValidationException::withMessages([
                'code' => "Kodning amal qilish muddati tugagan. Iltimos, yangi kod so'rang.",
            ]);
        }

        if ($data['attempts'] >= self::MAX_ATTEMPTS) {
            Cache::forget($cacheKey);
            throw ValidationException::withMessages([
                'code' => "Urinishlar soni tugadi. Iltimos, yangi kod so'rang.",
            ]);
        }

        if (!Hash::check($code, $data['hash'])) {
            $data['attempts']++;
            Cache::put($cacheKey, $data, max(1, $data['expires_at'] - time()));

            $left = self::MAX_ATTEMPTS - $data['attempts'];
            throw ValidationException::withMessages([
                'code' => $left > 0
                    ? "Kod noto'g'ri. Qolgan urinishlar: {$left}."
                    : "Kod noto'g'ri. Urinishlar soni tugadi, iltimos yangi kod so'rang.",
            ]);
        }

        Cache::forget($cacheKey);
        session()->put(self::SESSION_KEY . '.verified_until', time() + self::VERIFIED_TTL);

        return ['username' => $this->usernameFor($user)];
    }

    /**
     * Kod tasdiqlangan foydalanuvchi (parolni yangilash bosqichi uchun).
     */
    public function verifiedUser(): User
    {
        $state = session(self::SESSION_KEY);

        if (!$state || !$state['verified_until'] || $state['verified_until'] < time()) {
            throw ValidationException::withMessages([
                'password' => "Tasdiqlash muddati tugagan. Iltimos, parolni tiklashni qaytadan boshlang.",
            ]);
        }

        return $this->userRepository->findById($state['user_id']);
    }

    public function resetPassword(User $user, string $username, string $password): void
    {
        $this->userRepository->update($user, [
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        // Eski "meni eslab qol" sessiyalari bekor bo'ladi
        $user->forceFill(['remember_token' => Str::random(60)])->save();

        session()->forget(self::SESSION_KEY);

        Log::info("[PASSWORD RESET] Password updated for user #{$user->id}");
    }

    protected function findByUsername(string $username): User
    {
        $user = $this->userRepository->findByUsername(ltrim(trim($username), '@'));

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => 'Bunday username bilan foydalanuvchi topilmadi.',
            ]);
        }

        return $user;
    }

    protected function findByPhone(string $rawPhone): User
    {
        $user = $this->userRepository->findByPhone(VerificationController::formatPhone($rawPhone));

        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => "Bu telefon raqam bilan ro'yxatdan o'tgan foydalanuvchi topilmadi.",
            ]);
        }

        return $user;
    }

    protected function pendingUser(): User
    {
        $state = session(self::SESSION_KEY);

        if (!$state) {
            throw ValidationException::withMessages([
                'code' => "Sessiya muddati tugagan. Iltimos, parolni tiklashni qaytadan boshlang.",
            ]);
        }

        return $this->userRepository->findById($state['user_id']);
    }

    /**
     * Username bo'lmasa - taklif qilinadi (saqlanmaydi, foydalanuvchi o'zi tasdiqlaydi).
     */
    protected function usernameFor(User $user): string
    {
        return $user->username ?: $this->authService->generateUniqueUsername(
            (string) ($user->first_name ?: 'user'),
            (string) ($user->last_name ?? '')
        );
    }

    protected function sendEmail(User $user, string $code, int $ttl, string $errorKey): void
    {
        try {
            Mail::to($user->email)->send(new PasswordResetCodeMail(
                $code,
                trim("{$user->first_name} {$user->last_name}") ?: 'Foydalanuvchi',
                (int) ceil($ttl / 60)
            ));
        } catch (\Throwable $e) {
            Log::error("[PASSWORD RESET] Email send error for user #{$user->id}: " . $e->getMessage());
            throw ValidationException::withMessages([
                $errorKey => "Emailga kod yuborishda xatolik yuz berdi. Iltimos, keyinroq qayta urinib ko'ring.",
            ]);
        }
    }

    protected function sendSms(User $user, string $code): void
    {
        $phone = VerificationController::formatPhone($user->phone);

        $record = SmsNotification::create([
            'phone' => $phone,
            'code' => $code,
            'message' => "Parolni tiklash kodi: {$code}",
            'status' => 'pending',
        ]);

        SendSmsJob::dispatch($phone, $code, $record->id);
    }

    protected function isMockChannel(string $channel): bool
    {
        if ($channel === 'sms') {
            return $this->smsService->isMockMode();
        }

        return !app()->isProduction() && in_array(config('mail.default'), ['log', 'array'], true);
    }

    /**
     * Qayta yuborish orasidagi kutish va kunlik limit (SMS/email spam bo'lmasligi uchun).
     */
    protected function ensureNotThrottled(User $user, string $errorKey): void
    {
        $cooldownUntil = (int) Cache::get(self::COOLDOWN_PREFIX . $user->id, 0);
        if ($cooldownUntil > time()) {
            $seconds = $cooldownUntil - time();
            throw ValidationException::withMessages([
                $errorKey => "Kod yaqinda yuborilgan. Qayta yuborish uchun {$seconds} soniya kuting.",
            ]);
        }

        $dailyLimit = (int) config('usms.password_reset_daily_limit', 5);
        if ((int) Cache::get(self::DAILY_PREFIX . $user->id, 0) >= $dailyLimit) {
            throw ValidationException::withMessages([
                $errorKey => "Bugun parolni tiklash limiti ({$dailyLimit} marta) tugadi. Ertaga qayta urinib ko'ring.",
            ]);
        }
    }

    /**
     * @return int qayta yuborishgacha qolgan soniyalar
     */
    protected function hitThrottle(User $user): int
    {
        $cooldown = (int) config('usms.password_reset_resend_seconds', 60);
        Cache::put(self::COOLDOWN_PREFIX . $user->id, time() + $cooldown, $cooldown);

        $dailyKey = self::DAILY_PREFIX . $user->id;
        Cache::put($dailyKey, (int) Cache::get($dailyKey, 0) + 1, now()->endOfDay());

        return $cooldown;
    }

    protected function maskEmail(string $email): string
    {
        [$name, $domain] = explode('@', $email, 2) + [1 => ''];
        $visible = mb_strlen($name) <= 2 ? mb_substr($name, 0, 1) : mb_substr($name, 0, 2);

        return $visible . str_repeat('*', max(3, mb_strlen($name) - mb_strlen($visible))) . '@' . $domain;
    }

    protected function maskPhone(string $phone): string
    {
        $digits = substr(preg_replace('/[^\d]/', '', $phone), -9);

        return '+998 ' . substr($digits, 0, 2) . ' *** ** ' . substr($digits, -2);
    }
}
