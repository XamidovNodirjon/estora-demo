<?php

namespace App\Services;

use App\Http\Controllers\Auth\VerificationController;
use App\Jobs\SendCredentialsSmsJob;
use App\Models\SmsNotification;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Parolni tiklash: telefon raqam tizimda bo'lsa, foydalanuvchiga
 * username va yangi generatsiya qilingan parol SMS orqali yuboriladi.
 */
class PasswordResetService
{
    private const COOLDOWN_PREFIX = 'password_reset_cooldown_';
    private const DAILY_PREFIX = 'password_reset_daily_';
    private const PASSWORD_LENGTH = 8;

    public function __construct(
        protected UserRepository $userRepository,
        protected AuthService $authService,
        protected UsmsService $smsService
    ) {}

    /**
     * @return array{phone: string, username: string, password: ?string} password is returned only in SMS mock mode
     */
    public function resetByPhone(string $rawPhone): array
    {
        $phone = VerificationController::formatPhone($rawPhone);

        $this->ensureCredentialsCanBeDelivered();

        $user = $this->userRepository->findByPhone($phone);
        if (!$user) {
            throw ValidationException::withMessages([
                'phone' => "Bu telefon raqam bilan ro'yxatdan o'tgan foydalanuvchi topilmadi.",
            ]);
        }

        $this->ensureNotThrottled($phone);

        $password = $this->generatePassword();

        $username = DB::transaction(function () use ($user, $password) {
            $username = $user->username ?: $this->authService->generateUniqueUsername(
                (string) ($user->first_name ?: 'user'),
                (string) ($user->last_name ?? '')
            );

            $this->userRepository->update($user, [
                'username' => $username,
                'password' => Hash::make($password),
            ]);

            // Eski "meni eslab qol" sessiyalari bekor bo'ladi
            $user->forceFill(['remember_token' => Str::random(60)])->save();

            return $username;
        });

        $this->hitThrottle($phone);

        $record = SmsNotification::create([
            'phone' => $phone,
            'message' => "Parol tiklandi. Login: {$username}, yangi parol SMS orqali yuborildi.",
            'status' => 'pending',
        ]);
        SendCredentialsSmsJob::dispatch($phone, $username, $password, $record->id);

        Log::info("[PASSWORD RESET] Password reset for user #{$user->id}, credentials SMS queued to {$phone}");

        return [
            'phone' => $phone,
            'username' => $username,
            'password' => $this->smsService->isMockMode() ? $password : null,
        ];
    }

    /**
     * Readable random password: letters + digits, without ambiguous chars (0/O, 1/l/I).
     */
    public function generatePassword(): string
    {
        $letters = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $digits = '23456789';
        $all = $letters . $digits;

        $chars = [
            $letters[random_int(0, strlen($letters) - 1)],
            $digits[random_int(0, strlen($digits) - 1)],
        ];
        while (count($chars) < self::PASSWORD_LENGTH) {
            $chars[] = $all[random_int(0, strlen($all) - 1)];
        }

        // Kriptografik xavfsiz aralashtirish
        for ($i = count($chars) - 1; $i > 0; $i--) {
            $j = random_int(0, $i);
            [$chars[$i], $chars[$j]] = [$chars[$j], $chars[$i]];
        }

        return implode('', $chars);
    }

    /**
     * Begona odam boshqa birovning parolini qayta-qayta almashtira olmasligi uchun.
     */
    protected function ensureNotThrottled(string $phone): void
    {
        $cooldownUntil = (int) Cache::get(self::COOLDOWN_PREFIX . md5($phone), 0);
        if ($cooldownUntil > time()) {
            $minutes = (int) ceil(($cooldownUntil - time()) / 60);
            throw ValidationException::withMessages([
                'phone' => "Bu raqamga yangi parol yaqinda yuborilgan. {$minutes} daqiqadan keyin qayta urinib ko'ring.",
            ]);
        }

        $dailyLimit = (int) config('usms.password_reset_daily_limit', 3);
        if ((int) Cache::get(self::DAILY_PREFIX . md5($phone), 0) >= $dailyLimit) {
            throw ValidationException::withMessages([
                'phone' => "Bugun bu raqam uchun parolni tiklash limiti ({$dailyLimit} marta) tugadi. Ertaga qayta urinib ko'ring.",
            ]);
        }
    }

    protected function hitThrottle(string $phone): void
    {
        $cooldown = (int) config('usms.password_reset_cooldown_seconds', 300);
        Cache::put(self::COOLDOWN_PREFIX . md5($phone), time() + $cooldown, $cooldown);

        $dailyKey = self::DAILY_PREFIX . md5($phone);
        Cache::put($dailyKey, (int) Cache::get($dailyKey, 0) + 1, now()->endOfDay());
    }

    /**
     * Shablon sozlanmagan bo'lsa parol o'zgarib, foydalanuvchi uni ololmay qoladi -
     * shuning uchun bunday holatda parol umuman o'zgartirilmaydi.
     */
    protected function ensureCredentialsCanBeDelivered(): void
    {
        if (!$this->smsService->isMockMode() && (int) config('usms.password_reset_template_id', 0) <= 0) {
            Log::error('[PASSWORD RESET] USMS_PASSWORD_RESET_TEMPLATE_ID is not configured.');
            throw ValidationException::withMessages([
                'phone' => "Parolni tiklash xizmati vaqtincha ishlamayapti. Iltimos, administrator bilan bog'laning.",
            ]);
        }
    }
}
