<?php

namespace App\Jobs;

use App\Models\SmsNotification;
use App\Services\UsmsService;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

/**
 * Parol tiklangandan keyin foydalanuvchiga login va yangi parolni SMS orqali yuboradi.
 * Job payload shifrlanadi (ShouldBeEncrypted), chunki ichida ochiq parol bor.
 */
class SendCredentialsSmsJob implements ShouldQueue, ShouldBeEncrypted
{
    use Queueable;

    public int $tries = 3;

    public int $backoff = 5;

    public function __construct(
        public string $phone,
        public string $username,
        public string $password,
        public ?int $smsNotificationId = null
    ) {}

    public function handle(UsmsService $smsService): void
    {
        $record = $this->smsNotificationId ? SmsNotification::find($this->smsNotificationId) : null;

        try {
            $result = $smsService->sendCredentials($this->phone, $this->username, $this->password);

            // Parol hech qachon bazaga (sms_notifications) yozilmaydi
            $record?->update($result['success']
                ? ['status' => 'sent', 'sent_at' => now(), 'error' => null]
                : ['status' => 'failed', 'error' => $result['message'] ?? 'SMS yuborishda xatolik yuz berdi']);

            if ($result['success']) {
                Log::info("[SendCredentialsSmsJob] Credentials SMS sent to {$this->phone}");
            } else {
                Log::warning("[SendCredentialsSmsJob] Failed for {$this->phone}: " . ($result['message'] ?? ''));
            }
        } catch (\Throwable $e) {
            $record?->update(['status' => 'failed', 'error' => $e->getMessage()]);
            Log::error("[SendCredentialsSmsJob] Exception for {$this->phone}: " . $e->getMessage());
            throw $e;
        }
    }
}
