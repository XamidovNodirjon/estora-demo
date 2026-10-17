<?php

namespace App\Services;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Foydalanuvchi obunasini (tarifini) admin yoki dev tomonidan o'zgartirish.
 */
class SubscriptionService
{
    /**
     * Tarifni o'rnatadi. Bepul tarif tanlansa obuna bekor qilinadi.
     * Xuddi shu faol tarif uzaytirilsa - yangi muddat joriy tugash sanasidan qo'shiladi.
     */
    public function change(User $user, string $plan, ?string $period = null, ?Inquiry $inquiry = null): void
    {
        DB::transaction(function () use ($user, $plan, $period, $inquiry) {
            if ($plan === config('subscriptions.default', 'start')) {
                $user->forceFill([
                    'subscription_plan' => $plan,
                    'subscription_period' => null,
                    'subscription_expires_at' => null,
                ])->save();
            } else {
                $months = (int) config("subscriptions.periods.{$period}.months", 1);
                $from = $user->currentPlan() === $plan && $user->subscription_expires_at?->isFuture()
                    ? $user->subscription_expires_at
                    : Carbon::now();

                $user->forceFill([
                    'subscription_plan' => $plan,
                    'subscription_period' => $period,
                    'subscription_expires_at' => $from->copy()->addMonthsNoOverflow($months),
                ])->save();
            }

            // Ariza asosida o'zgartirilgan bo'lsa - ariza bajarildi deb belgilanadi
            $inquiry?->update(['status' => 'completed']);
        });

        Log::info("[SUBSCRIPTION] User #{$user->id} plan set to {$plan}" . ($period ? " ({$period})" : '') . ' by user #' . auth()->id());
    }
}
