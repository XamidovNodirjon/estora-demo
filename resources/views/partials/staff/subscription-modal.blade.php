{{-- Admin/dev: obunani o'zgartirish oynasi (TOP oynasi uslubida). subscription-badge tugmasi ochadi. --}}
@php
    $modalPlans = config('subscriptions.plans');
    $modalPeriods = config('subscriptions.periods');
    $modalDiscount = (float) config('subscriptions.yearly_discount', 0.5);
@endphp

<div id="subscriptionModal" class="fixed inset-0 z-[9999] flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#061c3f]/40 backdrop-blur-sm" onclick="closeSubscriptionModal()"></div>

    <!-- Modal Content -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 max-w-md w-full mx-4 shadow-2xl border border-slate-200 relative z-10 space-y-5 max-h-[calc(100vh-32px)] overflow-y-auto">
        <div class="text-center space-y-2">
            <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center text-2xl mx-auto border border-amber-200">
                <i class="fa-solid fa-crown"></i>
            </div>
            <h3 class="font-display font-black text-xl text-slate-900">Obunani o'zgartirish</h3>
            <p class="text-xs font-medium text-slate-500">
                <strong class="text-slate-900" data-sub-user></strong> &middot; hozir: <strong class="text-slate-900" data-sub-current></strong>
            </p>
        </div>

        <form id="subscriptionForm" method="POST" action="" class="space-y-4">
            @csrf
            <input type="hidden" name="inquiry_id" value="">

            <!-- Tarif -->
            <div class="grid grid-cols-3 gap-2">
                @foreach($modalPlans as $key => $plan)
                    <label class="cursor-pointer">
                        <input type="radio" name="plan" value="{{ $key }}" class="peer sr-only">
                        <span class="block text-center border-2 border-slate-300 rounded-xl px-2 py-3 peer-checked:border-[#0084ff] peer-checked:bg-blue-50 transition-all">
                            <span class="block font-black text-sm text-slate-900">{{ $plan['name'] }}</span>
                            <span class="block text-[11px] font-semibold text-slate-500 mt-0.5">
                                {{ $plan['monthly'] ? number_format($plan['monthly'], 0, '', ' ') . " / oy" : 'Bepul' }}
                            </span>
                        </span>
                    </label>
                @endforeach
            </div>

            <!-- Muddat (bepul tarifda kerak emas) -->
            <div data-sub-period-box>
                <span class="block text-xs font-bold text-slate-600 mb-1.5">Muddat</span>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($modalPeriods as $key => $period)
                        <label class="cursor-pointer">
                            <input type="radio" name="period" value="{{ $key }}" class="peer sr-only">
                            <span class="block text-center border-2 border-slate-300 rounded-xl py-2 text-xs font-bold text-slate-700 peer-checked:border-[#0084ff] peer-checked:bg-blue-50 peer-checked:text-[#0084ff] transition-all">
                                {{ $period['label'] }} ({{ $period['months'] }} oy)
                                @if($key === 'yearly')<span class="text-emerald-600">-{{ (int) ($modalDiscount * 100) }}%</span>@endif
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <p class="text-[11px] font-semibold text-slate-500 text-center" data-sub-hint></p>

            <div class="grid grid-cols-2 gap-3 pt-1">
                <button type="button" onclick="closeSubscriptionModal()" class="w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs rounded-xl transition-all">
                    Bekor qilish
                </button>
                <button type="submit" class="w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition-all shadow-md shadow-amber-500/20">
                    Tasdiqlash
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    (function () {
        const plans = @json(collect($modalPlans)->map(fn ($p) => $p['name']));
        const defaultPlan = @json(config('subscriptions.default'));
        const modal = document.getElementById('subscriptionModal');
        const form = document.getElementById('subscriptionForm');
        const periodBox = modal.querySelector('[data-sub-period-box]');
        const hint = modal.querySelector('[data-sub-hint]');

        function refresh() {
            const plan = form.querySelector('input[name="plan"]:checked')?.value;
            const isFree = plan === defaultPlan;
            periodBox.classList.toggle('hidden', isFree);
            periodBox.querySelectorAll('input').forEach(i => i.disabled = isFree);
            const inquiry = form.inquiry_id.value ? ' Ariza "Bajarildi" deb belgilanadi.' : '';
            hint.textContent = isFree
                ? "Pullik obuna bekor qilinadi, foydalanuvchi bepul START tarifiga o'tadi." + inquiry
                : `${plans[plan]} tarifi tanlangan muddatga faollashtiriladi (xuddi shu tarif uzaytirilsa - joriy muddatga qo'shiladi).` + inquiry;
        }

        window.openSubscriptionModal = function (btn) {
            form.action = btn.dataset.action;
            form.inquiry_id.value = btn.dataset.inquiry || '';
            modal.querySelector('[data-sub-user]').textContent = btn.dataset.user;
            modal.querySelector('[data-sub-current]').textContent = plans[btn.dataset.current] || btn.dataset.current;
            form.querySelector(`input[name="plan"][value="${btn.dataset.plan}"]`).checked = true;
            form.querySelector(`input[name="period"][value="${btn.dataset.period || 'monthly'}"]`).checked = true;
            refresh();
            modal.classList.remove('hidden');
        };

        window.closeSubscriptionModal = function () {
            modal.classList.add('hidden');
        };

        form.addEventListener('change', refresh);
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSubscriptionModal(); });
    })();
</script>
