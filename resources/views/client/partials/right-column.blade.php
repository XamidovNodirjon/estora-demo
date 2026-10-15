{{-- Kabinet o'ng ustuni: balans, verifikatsiya holati va shaxsiy havola --}}
@php
    $publicUrl = route('users.show', $user->username ?? $user->id);
    $fullyVerified = $verificationStatus['percentage'] >= 100;
@endphp

<!-- Balans (to'lov tizimi ulanmaguncha 0) -->
<div class="relative overflow-hidden rounded-2xl p-4 text-white bg-gradient-to-br from-[#0077FE] via-[#1A86FF] to-[#0062D6] shadow-md">
    <div class="absolute -right-10 -bottom-12 w-40 h-40 rounded-full bg-white/10"></div>
    <div class="absolute right-10 -top-16 w-36 h-36 rounded-full bg-white/5"></div>

    <div class="relative flex items-start justify-between">
        <span class="text-xs font-extrabold tracking-wide">BALANS</span>
        <span class="text-[10px] font-bold tracking-widest text-white">FREE</span>
    </div>

    <div class="relative flex items-center gap-2 mt-3">
        <span class="text-2xl font-black" data-balance-amount data-value="0 so'm">0 so'm</span>
        <button type="button" onclick="toggleBalanceVisibility(this)" class="text-white/90 hover:text-white cursor-pointer" title="Yashirish / ko'rsatish">
            <i class="fa-regular fa-eye text-sm"></i>
        </button>
    </div>

    <div class="relative flex items-end justify-between mt-4">
        <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="bg-amber-400 hover:bg-amber-300 text-white text-[10px] font-extrabold px-3 py-1 rounded-full flex items-center gap-1 transition-colors">
            <i class="fa-solid fa-plus text-[9px]"></i> To'ldirish
        </a>
        <img src="/images/logo.svg" alt="Estora" class="h-4 w-auto brightness-0 invert opacity-90">
    </div>
</div>

<!-- Verifikatsiya holati -->
@if($fullyVerified)
    <div class="rounded-2xl p-4 bg-emerald-500 text-white flex items-center gap-3 shadow-md">
        <span class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center text-xl flex-shrink-0"><i class="fa-solid fa-shield-halved"></i></span>
        <span>
            <span class="block text-sm font-extrabold leading-tight">Verifikatsiyadan o'tgan</span>
            <span class="block text-[10px] text-white/90 mt-0.5">Profilingiz to'liq tasdiqlangan.</span>
        </span>
    </div>
@else
    <a href="{{ route('client.dashboard', ['section' => 'account']) }}"
       @unless($verificationStatus['phone_verified']) onclick="event.preventDefault(); openPhoneVerificationModal();" @endunless
       class="rounded-2xl p-4 bg-amber-400 hover:bg-amber-500 text-white flex items-center gap-3 shadow-md transition-colors">
        <span class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center text-xl flex-shrink-0"><i class="fa-solid fa-shield-halved"></i></span>
        <span>
            <span class="block text-sm font-extrabold leading-tight">Verifikatsiyadan o'tilmagan</span>
            <span class="block text-[10px] text-white/90 mt-0.5">Platformada ishonchli foydalanish uchun profilingizni tasdiqlang ({{ $verificationStatus['percentage'] }}%).</span>
        </span>
    </a>
@endif

<!-- Shaxsiy havola -->
<div class="cabinet-panel p-4 space-y-3">
    <h4 class="font-extrabold text-slate-900 text-sm">Mening sahifam</h4>
    <p class="text-[11px] text-slate-500 leading-relaxed">Mijozlaringiz barcha e'lonlaringizni shu havola orqali ko'rishadi.</p>

    <div class="flex items-center gap-2 bg-slate-50 border border-slate-300 rounded-xl p-1.5 pl-3">
        <span class="text-[11px] font-bold text-[#0077FE] truncate flex-1 font-mono">{{ $publicUrl }}</span>
        <button type="button" onclick="copyToClipboard('{{ $publicUrl }}', this)" class="p-1.5 text-slate-500 hover:text-[#0077FE] bg-white rounded-lg border border-slate-300 cursor-pointer" title="Nusxalash">
            <i class="fa-regular fa-copy"></i>
        </button>
    </div>

    <a href="{{ $publicUrl }}" class="w-full border border-[#0077FE] text-[#0077FE] hover:bg-blue-50 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-2 transition-colors">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> Sahifani ochish
    </a>
</div>

@once
    @push('cabinet-scripts')
        <script>
            function toggleBalanceVisibility(btn) {
                const amount = document.querySelector('[data-balance-amount]');
                const hidden = amount.textContent === '••••••';
                amount.textContent = hidden ? amount.dataset.value : '••••••';
                btn.querySelector('i').className = hidden ? 'fa-regular fa-eye text-sm' : 'fa-regular fa-eye-slash text-sm';
            }
        </script>
    @endpush
@endonce
