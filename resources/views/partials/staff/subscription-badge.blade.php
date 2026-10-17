{{--
    Admin/dev: foydalanuvchi tarifi + "o'zgartirish" tugmasi (subscription-modal ochadi).
    Parametrlar: $user, $routePrefix ('admin' | 'developer'), ixtiyoriy $inquiry (ariza asosida tayyor tanlov bilan)
--}}
@php
    $subRole = $user->role?->name ?? $user->type;
    $subPlan = $user->currentPlan();
    $subStyles = [
        'start' => 'bg-gray-100 text-gray-700 border-gray-300',
        'basic' => 'bg-blue-50 text-blue-700 border-blue-300',
        'plus' => 'bg-purple-50 text-purple-700 border-purple-300',
    ];
    $inquiry = $inquiry ?? null;
@endphp

@if(in_array($subRole, config('subscriptions.roles'), true))
    <div class="flex flex-col items-start gap-1.5">
        <div class="leading-tight">
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full border text-xs font-bold {{ $subStyles[$subPlan] ?? $subStyles['start'] }}">
                @if($subPlan !== config('subscriptions.default'))<i class="fa-solid fa-crown text-[10px]"></i>@endif
                {{ config("subscriptions.plans.{$subPlan}.name") }}
            </span>
            @if($user->hasPaidPlan())
                <span class="block text-[11px] text-gray-500 mt-0.5">{{ $user->subscription_expires_at->format('d.m.Y') }} gacha</span>
            @elseif($user->subscriptionExpired())
                <span class="block text-[11px] text-red-600 font-semibold mt-0.5">Muddati tugagan</span>
            @endif
        </div>

        <button type="button"
                onclick="openSubscriptionModal(this)"
                data-action="{{ route($routePrefix . '.users.subscription', $user) }}"
                data-user="{{ $user->name }}"
                data-current="{{ $subPlan }}"
                data-plan="{{ $inquiry?->requested_plan ?? ($subPlan === config('subscriptions.default') ? 'basic' : $subPlan) }}"
                data-period="{{ $inquiry?->requested_period ?? ($user->subscription_period ?: 'monthly') }}"
                data-inquiry="{{ $inquiry?->id }}"
                class="{{ $inquiry ? 'px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white shadow-md shadow-amber-500/20' : 'px-2.5 py-1 border border-amber-300 text-amber-700 hover:bg-amber-50' }} rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 whitespace-nowrap"
                title="Obunani o'zgartirish">
            <i class="fa-solid fa-crown"></i>
            @if($inquiry)
                <span>{{ config("subscriptions.plans.{$inquiry->requested_plan}.name") }} ni yoqish</span>
            @else
                <span>O'zgartirish</span>
            @endif
        </button>
    </div>
@else
    <span class="text-xs text-gray-400">&mdash;</span>
@endif
