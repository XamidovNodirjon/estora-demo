<?php

namespace App\Jobs;

use App\Models\SmsNotification;
use App\Services\UsmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Queueable;

    public string $phone;
    public string $code;
    public ?int $smsNotificationId;
    public ?string $customMessage;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(string $phone, string $code, ?int $smsNotificationId = null, ?string $customMessage = null)
    {
        $this->phone             = $phone;
        $this->code              = $code;
        $this->smsNotificationId = $smsNotificationId;
        $this->customMessage     = $customMessage;
    }

    /**
     * Execute the job.
     */
    public function handle(UsmsService $smsService): void
    {
        $record = null;
        if ($this->smsNotificationId) {
            $record = SmsNotification::find($this->smsNotificationId);
        }

        if (!$record) {
            $record = SmsNotification::create([
                'phone'   => $this->phone,
                'code'    => $this->code,
                'message' => $this->customMessage ?? "Tasdiqlash kodi: {$this->code}",
                'status'  => 'pending',
            ]);
        }

        try {
            $result = $smsService->sendVerificationCode($this->phone, $this->code);

            if ($result['success']) {
                $record->update([
                    'status'   => 'sent',
                    'sent_at'  => now(),
                    'response' => json_encode($result, JSON_UNESCAPED_UNICODE),
                    'error'    => null,
                ]);
                Log::info("[SendSmsJob] SMS successfully sent to {$this->phone} (ID: {$record->id})");
            } else {
                $errorMsg = $result['message'] ?? 'SMS yuborishda xatolik yuz berdi';
                $record->update([
                    'status'   => 'failed',
                    'error'    => $errorMsg,
                    'response' => json_encode($result, JSON_UNESCAPED_UNICODE),
                ]);
                Log::warning("[SendSmsJob] SMS failed for {$this->phone} (ID: {$record->id}): {$errorMsg}");
            }
        } catch (\Throwable $e) {
            $record->update([
                'status' => 'failed',
                'error'  => $e->getMessage(),
            ]);
            Log::error("[SendSmsJob] Exception sending SMS to {$this->phone}: " . $e->getMessage());
            throw $e;
        }
    }
}
