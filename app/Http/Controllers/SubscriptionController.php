<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Admin va dev panellardan foydalanuvchi obunasini tez o'zgartirish
 * (foydalanuvchilar ro'yxati yoki arizalar sahifasidan).
 */
class SubscriptionController extends Controller
{
    public function __construct(
        protected SubscriptionService $service
    ) {}

    public function update(Request $request, User $user)
    {
        $plans = array_keys(config('subscriptions.plans'));
        $default = config('subscriptions.default', 'start');

        $validated = $request->validate([
            'plan' => ['required', Rule::in($plans)],
            'period' => ['nullable', 'required_unless:plan,' . $default, Rule::in(array_keys(config('subscriptions.periods')))],
            'inquiry_id' => ['nullable', 'integer', 'exists:inquiries,id'],
        ], [
            'plan.*' => "Tarifni to'g'ri tanlang.",
            'period.*' => "Obuna muddatini (oylik yoki yillik) tanlang.",
        ]);

        $inquiry = isset($validated['inquiry_id']) ? Inquiry::find($validated['inquiry_id']) : null;

        $this->service->change($user, $validated['plan'], $validated['period'] ?? null, $inquiry);

        $user->refresh();
        $message = $user->hasPaidPlan()
            ? "{$user->name}: " . config("subscriptions.plans.{$user->currentPlan()}.name") . ' tarifi ' . $user->subscription_expires_at->format('d.m.Y') . ' gacha faollashtirildi.'
            : "{$user->name}: obuna bekor qilindi (START tarifi).";

        return redirect()->back()->with('success', $message);
    }
}
