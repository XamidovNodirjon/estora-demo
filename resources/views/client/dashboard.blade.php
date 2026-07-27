@extends('layouts.client')

@section('title', 'Mening Kabinetim')

@section('content')
<div class="space-y-8">

    <!-- Premium Paid Announcement Promotion Card (Shown when free limit is reached) -->
    @if($isLimitReached)
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-[#061c3f] to-[#0B2240] p-8 text-white shadow-2xl border border-amber-500/30 animate-fade-in">
            <div class="absolute -right-6 -bottom-6 opacity-10 pointer-events-none">
                <i class="fa-solid fa-crown text-[200px] text-amber-400"></i>
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="max-w-xl space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold border border-amber-400/30 flex items-center gap-1.5">
                            <i class="fa-solid fa-bolt text-amber-400"></i> Pullik Xizmat & VIP E'lonlar
                        </span>
                        <span class="text-xs text-gray-300">Bepul limit: 2/2 ta to'lgan</span>
                    </div>

                    <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-white leading-tight">
                        Yangi e'loningizni <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-500">to'lov qilib</span> joylashtiring!
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                        Siz 2 ta bepul e'lon imkoniyatidan foydalandingiz. Keyingi e'lonlaringizni to'lov evaziga e'lon qilib, ko'chmas mulkingizni minglab xaridorlarga tezkor va VIP tartibda ko'rsating.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto flex-shrink-0">
                    <a href="{{ route('client.products.create') }}" class="px-6 py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-extrabold text-sm rounded-2xl shadow-lg hover:shadow-amber-500/25 transition-all text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-plus-circle text-base"></i> Pullik e'lon joylash (50 000 so'm)
                    </a>
                    <a href="#" class="px-5 py-3.5 bg-white/10 hover:bg-white/20 text-white font-semibold text-sm rounded-2xl border border-white/15 transition-all text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-wallet text-amber-400"></i> Balansni to'ldirish
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Welcome Card & Main Banner -->
    <div class="bg-gradient-to-r from-[#061c3f] to-[#0B2240] rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
        <div class="absolute right-0 bottom-0 top-0 opacity-10 flex items-center justify-center pr-8 pointer-events-none">
            <i class="fa-solid fa-building-circle-check text-[180px]"></i>
        </div>
        <div class="relative z-10 max-w-xl">
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full {{ $userRole === 'makler' ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
                    {{ $userRole === 'makler' ? 'Makler (Rieltor) Maqomi' : 'Uy egasi (Mijoz)' }}
                </span>
                <span class="text-xs text-gray-300">ID: {{ 2000000 + Auth::id() }}</span>
            </div>

            <h2 class="font-display font-bold text-3xl mb-2">Xush kelibsiz, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-300 text-sm leading-relaxed mb-6">
                ESTORA'ga qaytganingizdan mamnunmiz. Barcha imkoniyatlar siz uchun tayyor.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                @if($canCreateProduct)
                    <a href="{{ route('client.products.create') }}" class="px-6 py-3 bg-[#0084ff] hover:bg-[#0076e5] rounded-xl font-bold text-sm transition-all shadow-lg hover:shadow-cyan-500/20 transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> E'lon joylash
                    </a>
                @else
                    <a href="{{ route('client.products.create') }}" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl font-bold text-sm transition-all shadow-lg hover:shadow-amber-500/20 inline-flex items-center gap-2" title="Qo'shimcha e'lon joylashtirish (Pullik)">
                        <i class="fa-solid fa-crown text-amber-200"></i> Pullik e'lon joylash (50 000 so'm)
                    </a>
                @endif

                <a href="/" class="px-5 py-3 bg-white/10 hover:bg-white/20 rounded-xl font-semibold text-sm transition-all border border-white/10">
                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Uylarni qidirish
                </a>
            </div>
        </div>
    </div>

    <!-- Client Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat 1: Announcements & Limit -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-[#0084ff] flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Mening e'lonlarim</span>
                    <h3 class="font-display font-bold text-xl text-[#061c3f]">{{ $productCount }} ta e'lon</h3>
                </div>
            </div>
            <div class="text-right">
                @if($userRole === 'client')
                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold {{ $productCount >= 2 ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-blue-100 text-blue-700' }}">
                        {{ $productCount }}/2 tekin
                    </span>
                @else
                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                        <i class="fa-solid fa-infinity mr-1"></i> Cheksiz
                    </span>
                @endif
            </div>
        </div>

        <!-- Stat 2: Favorites -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center text-2xl">
                <i class="fa-regular fa-heart"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Saralangan e'lonlar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">0 ta uy</h3>
            </div>
        </div>

        <!-- Stat 3: Balance -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Hisob balansi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">1 250 000 so'm</h3>
            </div>
        </div>
    </div>

    <!-- Announcements Section (Compact Equal-Height List Row Cards) -->
    <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-gray-100 pb-4">
            <div>
                <h3 class="font-display font-bold text-xl text-[#061c3f]">Mening e'lonlarim</h3>
                <p class="text-xs text-gray-400 mt-0.5">Siz joylashtirgan barcha ko'chmas mulk ob'yektlari</p>
            </div>
        </div>

        <!-- PDF Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button class="px-4 py-2 rounded-xl text-xs font-bold bg-[#0084ff] text-white shadow-sm">
                Barchasi ({{ $productCount }})
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                Faol ({{ $userProducts->where('status', 'active')->count() }})
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                Nofaol ({{ $userProducts->where('status', '!=', 'active')->count() }})
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                Arxiv (0)
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                Kelishuvda (0)
            </button>
            <button class="px-4 py-2 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                Yopilgan e'lonlar (0)
            </button>
        </div>

        <!-- COMPACT EQUAL-HEIGHT LIST ROW CARDS STACK -->
        @if($userProducts->count() > 0)
            <div class="space-y-3">
                @foreach($userProducts as $product)
                    <div class="bg-white rounded-2xl border border-gray-200 p-3 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col sm:flex-row items-center justify-between gap-4 border-l-4 border-l-[#0084ff] h-auto sm:h-36 group">
                        
                        <!-- Left Small Thumbnail (Small 36x36 / 144px Box, Fixed Size for All Cards) -->
                        <div class="relative w-full sm:w-36 h-32 sm:h-full rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            @if(!empty($product->images) && count($product->images) > 0)
                                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400">
                                    <i class="fa-solid fa-house-chimney text-2xl"></i>
                                </div>
                            @endif

                            <!-- TOP Badge -->
                            <div class="absolute top-1.5 left-1.5 z-10">
                                <span class="px-1.5 py-0.5 rounded bg-amber-500 text-white font-black text-[9px] tracking-wider uppercase shadow">
                                    TOP
                                </span>
                            </div>

                            <!-- Favorite Heart Button -->
                            <div class="absolute top-1.5 right-1.5 z-10">
                                <button type="button" class="w-6 h-6 rounded-full bg-white/80 backdrop-blur-md hover:bg-white text-gray-600 hover:text-red-500 flex items-center justify-center text-[10px] shadow transition-all">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>

                            <!-- "Yaxshi Taklif" Badge -->
                            <div class="absolute bottom-1.5 left-1.5 z-10">
                                <span class="px-1.5 py-0.5 rounded bg-amber-500 text-white font-bold text-[9px] shadow">
                                    Yaxshi Taklif
                                </span>
                            </div>
                        </div>

                        <!-- Right Product Details Column (Fits Neatly in h-36) -->
                        <div class="flex-1 min-w-0 flex flex-col justify-between h-full space-y-1 py-0.5">
                            <div>
                                <!-- Header Row: Title, Badges, Price & Time -->
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-1.5 mb-0.5">
                                            <span class="px-1.5 py-0.2 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Faol</span>
                                            <span class="px-1.5 py-0.2 rounded bg-amber-50 text-amber-700 text-[10px] font-bold border border-amber-200">VIP / TOP</span>
                                        </div>
                                        <h4 class="font-display font-bold text-base text-[#061c3f] truncate group-hover:text-[#0084ff] transition-all">
                                            <a href="{{ route('products.show', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h4>
                                    </div>

                                    <!-- Price & Time -->
                                    <div class="text-right flex-shrink-0">
                                        <div class="font-display font-black text-base sm:text-lg text-amber-500 leading-tight">
                                            {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-bold text-amber-600">y.e</span>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium block">
                                            {{ $product->created_at ? $product->created_at->diffForHumans() : '' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Address Location & Stars -->
                                <div class="flex items-center justify-between gap-2 mt-0.5">
                                    <p class="text-xs text-gray-500 truncate flex items-center gap-1">
                                        <i class="fa-solid fa-location-dot text-[#0084ff]"></i>
                                        {{ $product->region->name ?? '' }} {{ $product->city ? ', ' . $product->city->name : '' }} {{ $product->landmark ? ', ' . $product->landmark : '' }}
                                    </p>
                                    <div class="flex items-center gap-0.5 text-amber-400 text-[10px] flex-shrink-0">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star text-gray-300"></i>
                                    </div>
                                </div>

                                <!-- Specs Pills (Etaj, Xona, m²) -->
                                <div class="flex items-center gap-1.5 mt-1.5">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-[11px] border border-blue-100">
                                        <i class="fa-solid fa-building text-[#0084ff]"></i>
                                        {{ $product->floor ?? 1 }}/{{ $product->building_floor ?? 9 }} etaj
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-[11px] border border-blue-100">
                                        <i class="fa-solid fa-door-open text-[#0084ff]"></i>
                                        {{ $product->rooms ?? 1 }} xona
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-[11px] border border-blue-100">
                                        <i class="fa-solid fa-ruler-combined text-[#0084ff]"></i>
                                        {{ $product->square ?? 0 }}m²
                                    </span>
                                </div>
                            </div>

                            <!-- Bottom Line: Tags & Action Buttons -->
                            <div class="pt-1.5 border-t border-gray-100 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-1.5 flex-wrap min-w-0">
                                    <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-800 border border-amber-100 text-[10px] font-semibold flex items-center gap-1">
                                        <i class="fa-solid fa-screwdriver-wrench text-amber-500"></i>
                                        {{ $product->repair ?? 'Evro' }}
                                    </span>

                                    @if($product->metros && $product->metros->count() > 0)
                                        <span class="px-2 py-0.5 rounded-md bg-blue-50 text-[#0084ff] border border-blue-100 text-[10px] font-semibold flex items-center gap-1 truncate">
                                            <i class="fa-solid fa-train-subway text-[#0084ff]"></i>
                                            {{ $product->metros->first()->name }} Metro
                                        </span>
                                    @endif

                                    @if($product->universities && $product->universities->count() > 0)
                                        <span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 border border-purple-100 text-[10px] font-semibold flex items-center gap-1 truncate">
                                            <i class="fa-solid fa-graduation-cap text-purple-600"></i>
                                            {{ $product->universities->first()->name }}
                                        </span>
                                    @endif

                                    <!-- Private View Counter (Owner only) -->
                                    <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-700 border border-gray-200 text-[10px] font-bold flex items-center gap-1" title="Faqat sizga ko'rinadigan ko'rishlar soni">
                                        <i class="fa-solid fa-eye text-[#0084ff]"></i>
                                        {{ number_format($product->views_count, 0, ',', ' ') }}
                                    </span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    <a href="{{ route('products.show', $product->id) }}" class="px-2.5 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-[11px] transition-all flex items-center gap-1">
                                        <i class="fa-solid fa-eye text-[9px]"></i> Ko'rish
                                    </a>
                                    <a href="{{ route('client.products.edit', $product->id) }}" class="px-2.5 py-1 rounded-lg bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-[11px] transition-all shadow-sm flex items-center gap-1">
                                        <i class="fa-solid fa-pen-to-square text-[9px]"></i> Tahrirlash
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                <i class="fa-regular fa-folder-open text-gray-400 text-4xl mb-4 block"></i>
                <h4 class="font-semibold text-gray-600 text-sm mb-1">Hozircha hech qanday e'lonlar joylashtirilmagan</h4>
                <p class="text-xs text-gray-400 max-w-xs mx-auto mb-4">Uyingizni sotish yoki ijaraga berish uchun birinchi e'loningizni qo'shing.</p>
                <a href="{{ route('client.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0084ff] text-white rounded-xl font-bold text-xs shadow hover:bg-[#0076e5] transition-all">
                    <i class="fa-solid fa-plus"></i> Birinchi e'lonni berish
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
