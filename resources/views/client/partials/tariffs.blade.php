{{-- Tariflar (config/subscriptions.php): oylik / yillik. To'lov tizimi ulanmaguncha obuna so'rovi ariza sifatida yuboriladi, admin/dev uni panelda faollashtiradi. --}}
@php
    $plans = config('subscriptions.plans');
    $defaultPlan = config('subscriptions.default', 'start');
    $currentPlan = $user->currentPlan();
    $discount = (float) config('subscriptions.yearly_discount', 0.5);
    $formatPrice = fn (int $amount) => number_format($amount, 0, '', ' ');
@endphp

<div class="cabinet-panel px-4 sm:px-8 py-6 sm:py-8" data-tariffs>
    <!-- Oylik / Yillik -->
    <div class="flex justify-center">
        <div class="inline-flex items-center gap-1 border border-slate-300 rounded-full p-1 shadow-sm bg-white">
            <button type="button" data-period="monthly" class="tariff-period bg-[#0077FE] text-white text-xs font-black px-6 py-2 rounded-full cursor-pointer transition-colors">OYLIK</button>
            <button type="button" data-period="yearly" class="tariff-period text-slate-800 text-xs font-black px-4 py-2 rounded-full flex items-center gap-2 cursor-pointer transition-colors">
                YILLIK <span class="bg-emerald-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">-50%</span>
            </button>
        </div>
    </div>
    <p class="text-center text-[11px] text-slate-500 mt-3">Estora imkoniyatlaridan o'zingizga mos tarif orqali foydalaning.</p>

    <!-- Joriy obuna holati -->
    @if($user->hasPaidPlan())
        <div class="max-w-[680px] mx-auto mt-5 p-3 rounded-xl bg-blue-50 border border-blue-200 text-[11px] font-semibold text-blue-800 flex items-center gap-2">
            <i class="fa-solid fa-crown text-[#0077FE]"></i>
            <span>Joriy tarif: <b>{{ $plans[$currentPlan]['name'] }}</b> &mdash; {{ $user->subscription_expires_at->format('d.m.Y') }} gacha amal qiladi.</span>
        </div>
    @elseif($user->subscriptionExpired())
        <div class="max-w-[680px] mx-auto mt-5 p-3 rounded-xl bg-amber-50 border border-amber-300 text-[11px] font-semibold text-amber-800 flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>{{ $plans[$user->subscription_plan]['name'] ?? '' }} tarifingiz muddati {{ $user->subscription_expires_at->format('d.m.Y') }} da tugagan. Uzaytirish uchun obuna so'rovini yuboring.</span>
        </div>
    @endif

    <!-- Tarif kartalari -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-4 mt-8 md:items-start max-w-[680px] mx-auto">
        @foreach($plans as $planKey => $plan)
            @php
                $yearly = (int) round($plan['monthly'] * 12 * (1 - $discount));
                $isFeatured = !empty($plan['featured']);
                $isCurrent = $planKey === $currentPlan;
            @endphp
            <div class="bg-white border border-slate-300 rounded-2xl p-5 flex flex-col shadow-[0_8px_24px_-12px_rgba(15,23,42,0.25)] {{ $isFeatured ? 'md:-mt-6 md:pb-6' : 'md:mt-6' }}">
                <div class="text-[#0077FE] font-black leading-none">
                    @if($plan['monthly'] === 0)
                        <span class="text-2xl">FREE</span> <span class="text-sm font-bold">/ oylik</span>
                    @else
                        <span class="text-2xl" data-price-monthly>{{ $formatPrice($plan['monthly']) }}</span>
                        <span class="text-2xl hidden" data-price-yearly>{{ $formatPrice($yearly) }}</span>
                        <span class="text-sm font-bold" data-period-label>/ oylik</span>
                    @endif
                </div>

                <h4 class="font-black text-slate-900 text-sm mt-4">{{ $plan['name'] }}</h4>
                <p class="text-[10px] text-slate-500 leading-snug mt-0.5">{{ $plan['subtitle'] }}</p>

                <ul class="space-y-1.5 mt-4 flex-1">
                    @foreach($plan['features'] as $feature)
                        <li class="flex items-start gap-1.5 text-[10px] text-slate-700 leading-snug">
                            <i class="fa-solid fa-circle-check text-[#0077FE] text-[10px] mt-0.5"></i>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>

                @if($isCurrent && $planKey === $defaultPlan)
                    <span class="mt-5 w-full text-center border-2 border-[#0077FE] text-[#0077FE] font-black text-xs py-2.5 rounded-full">
                        JORIY TARIF
                    </span>
                @elseif($planKey === $defaultPlan)
                    <span class="mt-5 w-full text-center border-2 border-slate-300 text-slate-500 font-black text-xs py-2.5 rounded-full">
                        BEPUL
                    </span>
                @elseif($isCurrent)
                    <button type="button" data-subscribe="{{ $planKey }}" data-plan-name="{{ $plan['name'] }}"
                            class="mt-5 w-full border-2 border-[#0077FE] text-[#0077FE] hover:bg-blue-50 font-black text-xs py-2.5 rounded-full cursor-pointer transition-colors">
                        JORIY TARIF &middot; UZAYTIRISH
                    </button>
                @else
                    <button type="button" data-subscribe="{{ $planKey }}" data-plan-name="{{ $plan['name'] }}"
                            class="mt-5 w-full bg-[#0077FE] hover:bg-blue-600 text-white font-black text-xs py-2.5 rounded-full cursor-pointer transition-colors">
                        OBUNA OLISH
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    <div class="w-36 h-px bg-slate-300 mx-auto mt-8"></div>
</div>

@once
    @push('cabinet-scripts')
        <script>
            document.querySelectorAll('[data-tariffs]').forEach(function (root) {
                let period = 'monthly';
                const buttons = root.querySelectorAll('.tariff-period');

                buttons.forEach(btn => btn.addEventListener('click', function () {
                    period = this.dataset.period;
                    buttons.forEach(b => {
                        const on = b === this;
                        b.classList.toggle('bg-[#0077FE]', on);
                        b.classList.toggle('text-white', on);
                        b.classList.toggle('text-slate-800', !on);
                    });
                    root.querySelectorAll('[data-price-monthly]').forEach(el => el.classList.toggle('hidden', period !== 'monthly'));
                    root.querySelectorAll('[data-price-yearly]').forEach(el => el.classList.toggle('hidden', period !== 'yearly'));
                    root.querySelectorAll('[data-period-label]').forEach(el => el.textContent = period === 'monthly' ? '/ oylik' : '/ yillik');
                }));

                // To'lov tizimi ulanmaguncha - obuna so'rovi "Savollaringiz bormi?" modali orqali yuboriladi
                root.querySelectorAll('[data-subscribe]').forEach(btn => btn.addEventListener('click', function () {
                    const label = period === 'monthly' ? 'oylik' : 'yillik';
                    openSupportModal(`${this.dataset.planName} tarifiga (${label}) obuna bo'lmoqchiman.`, this.dataset.subscribe, period);
                }));
            });
        </script>
    @endpush
@endonce
