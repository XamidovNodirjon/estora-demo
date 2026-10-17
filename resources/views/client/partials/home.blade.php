{{-- Kabinet bosh sahifasi: profil kartasi, tezkor kartalar va e'lonlar --}}
@php
    $isVerified = $verificationStatus['phone_verified'];
    $trust = $verificationStatus['percentage'];
@endphp

<!-- Profil kartasi -->
<div class="cabinet-panel p-4 sm:p-5">
    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-5">
        <div class="relative w-[76px] h-[76px] flex-shrink-0">
            <div class="w-full h-full rounded-full border-2 border-[#0077FE] bg-white overflow-hidden flex items-center justify-center text-slate-300 text-3xl">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <i class="fa-regular fa-image"></i>
                @endif
            </div>
            @if($isVerified)
                <span class="absolute top-0 right-0 w-5 h-5 rounded-full bg-[#0077FE] text-white text-[9px] flex items-center justify-center ring-2 ring-white" title="Tasdiqlangan">
                    <i class="fa-solid fa-check"></i>
                </span>
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <div class="text-[10px] font-semibold text-slate-500">ID: {{ 2000000 + $user->id }}</div>
            <h2 class="font-black text-slate-900 text-lg leading-tight truncate">{{ $user->name }}</h2>

            <div class="flex items-center gap-2 mt-2 flex-wrap">
                <span class="border border-slate-300 rounded-md px-2 py-0.5 leading-none" title="Reyting (sharhlar tizimi tez orada)">
                    <span class="block text-[11px] font-black text-slate-800">—</span>
                    <span class="block text-[10px] font-semibold text-slate-600">Reyting</span>
                </span>
                <a href="{{ route('client.dashboard', ['section' => 'account']) }}" class="border border-slate-300 rounded-md px-2 py-0.5 leading-none hover:border-[#0077FE]" title="Profil to'liqligi">
                    <span class="block text-[11px] font-black text-slate-800">{{ $trust }}% <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i></span>
                    <span class="block text-[10px] font-semibold text-slate-600">Ishonch</span>
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="border border-[#0077FE] bg-blue-50 text-[#0077FE] rounded-md px-3 py-1 text-[10px] font-bold flex items-center gap-1.5" title="{{ $user->hasPaidPlan() ? 'Tarif ' . $user->subscription_expires_at->format('d.m.Y') . ' gacha' : 'Tarifingiz' }}">
                    <i class="fa-solid {{ $user->hasPaidPlan() ? 'fa-crown' : 'fa-shield-halved' }}"></i> {{ $user->planInfo()['badge'] }}
                </a>
            </div>
        </div>

        <div class="flex sm:flex-col items-center sm:items-end justify-between gap-3 sm:self-stretch">
            <span class="text-[11px] font-semibold text-slate-500">Tizimda: {{ $user->created_at?->format('d.m.Y') }}</span>
            @if($verificationStatus['can_create_ad'])
                <a href="{{ route('client.products.create') }}" class="bg-[#0077FE] hover:bg-blue-600 text-white text-[11px] font-bold px-5 py-2 rounded-md flex items-center gap-2 transition-colors">
                    <i class="fa-solid fa-table-cells-large"></i> E'lon joylash
                </a>
            @else
                <button type="button" onclick="handleBlockedAdCreation()" class="bg-[#0077FE] hover:bg-blue-600 text-white text-[11px] font-bold px-5 py-2 rounded-md flex items-center gap-2 transition-colors cursor-pointer">
                    <i class="fa-solid fa-table-cells-large"></i> E'lon joylash
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Tezkor kartalar -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-2.5">
    @if($verificationStatus['can_create_ad'])
        <a href="{{ route('client.products.create') }}" class="border border-emerald-500 rounded-lg p-2.5 flex items-center gap-2.5 hover:shadow-md transition-shadow bg-white">
            <span class="w-8 h-8 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-unlock"></i></span>
            <span class="min-w-0">
                <span class="block text-[11px] font-extrabold text-emerald-600">Aktiv rejim yoqilgan</span>
                <span class="block text-[10px] font-semibold text-slate-600 leading-tight">Endi e'lon joylashingiz mumkin.</span>
            </span>
        </a>
    @else
        <button type="button" onclick="openPhoneVerificationModal()" class="border border-amber-500 rounded-lg p-2.5 flex items-center gap-2.5 hover:shadow-md transition-shadow bg-white text-left cursor-pointer">
            <span class="w-8 h-8 rounded-md bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-lock"></i></span>
            <span class="min-w-0">
                <span class="block text-[11px] font-extrabold text-amber-500">Aktiv rejimga o'ting</span>
                <span class="block text-[10px] font-semibold text-slate-600 leading-tight">Verifikatsiyadan o'tgandan so'ng e'lon joylashingiz mumkin.</span>
            </span>
        </button>
    @endif

    <a href="{{ route('users.show', $user->username ?? $user->id) }}" class="border border-emerald-600 rounded-lg p-2.5 flex items-center gap-2.5 hover:shadow-md transition-shadow bg-white">
        <span class="w-8 h-8 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-link"></i></span>
        <span class="min-w-0">
            <span class="block text-[11px] font-extrabold text-emerald-600">Mening sahifam</span>
            <span class="block text-[10px] font-semibold text-slate-600 leading-tight">Platforma ichida o'z sahifangiz, barchasi yanada qulayroq.</span>
        </span>
    </a>

    <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" class="border border-purple-500 rounded-lg p-2.5 flex items-center gap-2.5 hover:shadow-md transition-shadow bg-white">
        <span class="w-8 h-8 rounded-md bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-chart-column"></i></span>
        <span class="min-w-0">
            <span class="block text-[11px] font-extrabold text-purple-600">Statistika</span>
            <span class="block text-[10px] font-semibold text-slate-600 leading-tight">E'lonlaringiz natijasini doimiy kuzatib boring.</span>
        </span>
    </a>

    <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="border border-[#0077FE] rounded-lg p-2.5 flex items-center gap-2.5 hover:shadow-md transition-shadow bg-white">
        <span class="w-8 h-8 rounded-md bg-blue-50 text-[#0077FE] flex items-center justify-center flex-shrink-0"><i class="fa-regular fa-comments"></i></span>
        <span class="min-w-0">
            <span class="block text-[11px] font-extrabold text-[#0077FE]">Chatlar</span>
            <span class="block text-[10px] font-semibold text-slate-600 leading-tight">Mijozlaringiz bilan platformaning o'zida to'g'ridan-to'g'ri suhbat.</span>
        </span>
    </a>
</div>

@include('client.partials.my-products', ['limit' => 5])
