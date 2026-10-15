{{-- Tariflar: oylik / yillik (-50%). To'lov tizimi ulanmaguncha obuna so'rovi murojaat orqali yuboriladi. --}}
@php
    $plans = [
        [
            'key' => 'start', 'name' => 'START', 'monthly' => 0,
            'subtitle' => "Talabalar va asosiy uy-joy ehtiyojlari uchun.",
            'features' => [
                "Xonadosh qidirish va e'lon joylashtirish",
                "Uy-joy e'lonlarini ko'rish",
                'Vositachili va vositachisiz uylarni qidirish',
                "To'liq qidiruv va filtr imkoniyatlari",
                'Xarita orqali qidirish',
                "Uy egasi yoki boshqa foydalanuvchi bilan to'g'ridan-to'g'ri aloqa",
                "E'lon bo'yicha asosiy ma'lumotlarni ko'rish",
            ],
        ],
        [
            'key' => 'basic', 'name' => 'BASIC', 'monthly' => 4990, 'featured' => true,
            'subtitle' => "Kengaytirilgan uy-joy qidiruvi va boshqaruvi.",
            'features' => [
                'FREE tarifidagi barcha imkoniyatlar +',
                "10 tagacha aktiv e'lon",
                "Metro va universitetlar atrofida yoki istalgan nuqta belgilagan holda radius bo'yicha uy qidirish",
                "Tekshiruvdan o'tgan ishonchli maklerlar",
                '3D va video tur',
                "Bozor narxini avtomatik baholash, narx bo'yicha bepul tavsiyalar",
                'Uy bron qilish',
                'Narx taklifi yuborish',
                'ESTORA AI Agent (cheklangan)',
            ],
        ],
        [
            'key' => 'plus', 'name' => 'PLUS', 'monthly' => 9990,
            'subtitle' => "Ko'chmas mulk va investitsiyalar uchun kengaytirilgan imkoniyatlar",
            'features' => [
                'BASIC tarifidagi barcha imkoniyatlar +',
                "ESTORA AI Agent (to'liq boshqaruv)",
                "To'liq bozor tahlili",
                'Investitsiya indeksi',
                "Daromadlilik va ishonchlilik ko'rsatkichlari",
                'Ijara va sotuv daromadlari statistikasi',
                'Investitsiya uchun obyektlarni AI orqali tahlil qilish',
                'Bepul mutaxassis maslahatlari',
                'Uy qiymati va bozor istiqboli tahlili',
                'Auksion orqali savdo',
            ],
        ],
    ];
    $currentPlan = 'start';
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

    <!-- Tarif kartalari -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-4 mt-8 md:items-start max-w-[680px] mx-auto">
        @foreach($plans as $plan)
            @php
                $yearly = (int) round($plan['monthly'] * 12 * 0.5);
                $isFeatured = !empty($plan['featured']);
                $isCurrent = $plan['key'] === $currentPlan;
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

                @if($isCurrent)
                    <span class="mt-5 w-full text-center border-2 border-[#0077FE] text-[#0077FE] font-black text-xs py-2.5 rounded-full">
                        JORIY TARIF
                    </span>
                @else
                    <button type="button" data-subscribe="{{ $plan['name'] }}"
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
                    openSupportModal(`${this.dataset.subscribe} tarifiga (${label}) obuna bo'lmoqchiman.`);
                }));
            });
        </script>
    @endpush
@endonce
