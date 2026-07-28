@extends('layouts.client')

@section('title', 'Mening Kabinetim')

@section('content')
<div class="space-y-4 sm:space-y-8">

    <!-- Premium Paid Announcement Promotion Card (Shown when free limit is reached) -->
    @if($isLimitReached)
        <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl bg-gradient-to-r from-slate-900 via-[#061c3f] to-[#0B2240] p-5 sm:p-8 text-white shadow-2xl border border-amber-500/30 animate-fade-in">
            <div class="absolute -right-6 -bottom-6 opacity-10 pointer-events-none">
                <i class="fa-solid fa-crown text-[140px] sm:text-[200px] text-amber-400"></i>
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 sm:gap-6">
                <div class="max-w-xl space-y-2 sm:space-y-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[11px] font-bold border border-amber-400/30 flex items-center gap-1">
                            <i class="fa-solid fa-bolt text-amber-400"></i> Pullik Xizmat & VIP
                        </span>
                        <span class="text-xs text-gray-300">Bepul limit: 2/2 ta to'lgan</span>
                    </div>

                    <h3 class="font-display font-extrabold text-xl sm:text-3xl text-white leading-tight">
                        Yangi e'loningizni <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-500">to'lov qilib</span> joylashtiring!
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                        Siz 2 ta bepul e'lon imkoniyatidan foydalandingiz. Keyingi e'lonlaringizni to'lov evaziga joylashtirib, ko'chmas mulkingizni tezkor va VIP tartibda ko'rsating.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full lg:w-auto flex-shrink-0 pt-2 lg:pt-0">
                    <a href="{{ route('client.products.create') }}" class="px-5 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-extrabold text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg transition-all text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-plus-circle"></i> Pullik e'lon (50 000 so'm)
                    </a>
                    <a href="#" class="px-4 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm rounded-xl sm:rounded-2xl border border-white/15 transition-all text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-wallet text-amber-400"></i> Balansni to'ldirish
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Welcome Card & Main Banner -->
    <div class="bg-gradient-to-r from-[#061c3f] to-[#0B2240] rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white relative overflow-hidden shadow-xl">
        <div class="absolute right-0 bottom-0 top-0 opacity-10 flex items-center justify-center pr-4 sm:pr-8 pointer-events-none">
            <i class="fa-solid fa-building-circle-check text-[120px] sm:text-[180px]"></i>
        </div>
        <div class="relative z-10 max-w-xl">
            <div class="flex items-center gap-2 mb-2 sm:mb-3 flex-wrap">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 text-white text-[11px] font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full {{ $userRole === 'makler' ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
                    {{ $userRole === 'makler' ? 'Makler (Rieltor)' : 'Uy egasi' }}
                </span>
                <span class="text-[11px] text-gray-300">ID: {{ 2000000 + Auth::id() }}</span>
            </div>

            <h2 class="font-display font-bold text-2xl sm:text-3xl mb-1.5 sm:mb-2">Xush kelibsiz, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-300 text-xs sm:text-sm leading-relaxed mb-4 sm:mb-6">
                ESTORA'ga qaytganingizdan mamnunmiz. Barcha imkoniyatlar siz uchun tayyor.
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                @if($canCreateProduct)
                    <a href="{{ route('client.products.create') }}" class="px-5 py-2.5 sm:py-3 bg-[#0084ff] hover:bg-[#0076e5] rounded-xl font-bold text-xs sm:text-sm transition-all shadow-lg text-center inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-plus"></i> E'lon joylash
                    </a>
                @else
                    <a href="{{ route('client.products.create') }}" class="px-5 py-2.5 sm:py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 text-white rounded-xl font-bold text-xs sm:text-sm transition-all shadow-lg text-center inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-crown text-amber-200"></i> Pullik e'lon (50 000 so'm)
                    </a>
                @endif

                <a href="/" class="px-4 py-2.5 sm:py-3 bg-white/10 hover:bg-white/20 rounded-xl font-semibold text-xs sm:text-sm transition-all border border-white/10 text-center">
                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Uylarni qidirish
                </a>
            </div>
        </div>
    </div>

    <!-- Client Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
        <!-- Stat 1: Announcements & Limit -->
        <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 shadow-sm hover:shadow-md transition-all flex items-center justify-between group">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-blue-500/10 text-[#0084ff] group-hover:bg-[#0084ff] group-hover:text-white transition-all flex items-center justify-center text-xl sm:text-2xl flex-shrink-0">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <span class="block text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Mening e'lonlarim</span>
                    <h3 class="font-display font-bold text-lg sm:text-xl text-[#061c3f]">{{ $productCount }} ta e'lon</h3>
                </div>
            </div>
            <div class="text-right flex-shrink-0">
                @if($userRole === 'client')
                    <span class="inline-block px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full text-[11px] font-bold {{ $productCount >= 2 ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-blue-100 text-blue-700' }}">
                        {{ $productCount }}/2 tekin
                    </span>
                @else
                    <span class="inline-block px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700">
                        <i class="fa-solid fa-infinity mr-1"></i> Cheksiz
                    </span>
                @endif
            </div>
        </a>

        <!-- Stat 2: Favorites -->
        <a href="{{ route('client.dashboard', ['section' => 'favorites']) }}" class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 shadow-sm hover:shadow-md transition-all flex items-center justify-between group">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-red-500/10 text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all flex items-center justify-center text-xl sm:text-2xl flex-shrink-0">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <div>
                    <span class="block text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Saralangan e'lonlar</span>
                    <h3 class="font-display font-bold text-lg sm:text-xl text-[#061c3f]">{{ $favoriteCount }} ta uy</h3>
                </div>
            </div>
            <div class="text-right flex-shrink-0">
                <span class="inline-block px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-700">
                    <i class="fa-solid fa-bookmark mr-1"></i> Saqlangan
                </span>
            </div>
        </a>

        <!-- Stat 3: Balance -->
        <div class="bg-white rounded-2xl border border-gray-200 p-4 sm:p-6 shadow-sm flex items-center gap-3 sm:gap-5 col-span-1 sm:col-span-2 md:col-span-1">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl sm:text-2xl flex-shrink-0">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="block text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Hisob balansi</span>
                <h3 class="font-display font-bold text-lg sm:text-2xl text-[#061c3f]">1 250 000 so'm</h3>
            </div>
        </div>
    </div>

    <!-- Main Section Content Card -->
    <div class="bg-white rounded-2xl sm:rounded-3xl border border-gray-200 p-4 sm:p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4 mb-4 sm:mb-6 border-b border-gray-100 pb-3 sm:pb-4">
            <div>
                <h3 class="font-display font-bold text-lg sm:text-xl text-[#061c3f]">
                    {{ $section === 'favorites' ? "Saralangan e'lonlar" : "Mening e'lonlarim" }}
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $section === 'favorites' ? "O'zingiz uchun saqlab qo'ygan ko'chmas mulk ob'yektlari" : "Siz joylashtirgan barcha ko'chmas mulk ob'yektlari" }}
                </p>
            </div>

            <!-- Section Tab Buttons (50/50 full width on mobile) -->
            <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-xl sm:rounded-2xl w-full sm:w-auto">
                <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex-1 sm:flex-initial text-center px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl text-xs font-bold transition-all {{ $section !== 'favorites' ? 'bg-[#0084ff] text-white shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                    <i class="fa-solid fa-folder-open mr-1"></i> Mening e'lonlarim ({{ $productCount }})
                </a>
                <a href="{{ route('client.dashboard', ['section' => 'favorites']) }}" class="flex-1 sm:flex-initial text-center px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl text-xs font-bold transition-all {{ $section === 'favorites' ? 'bg-red-500 text-white shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                    <i class="fa-solid fa-heart mr-1"></i> Saralanganlar ({{ $favoriteCount }})
                </a>
            </div>
        </div>

        @if($section !== 'favorites')
            <!-- MY ANNOUNCEMENTS SECTION -->
            
            <!-- Status Filter Tabs (Scrollable on mobile) -->
            <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1 mb-4 sm:mb-6">
                <button class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-[#0084ff] text-white shadow-sm whitespace-nowrap">
                    Barchasi ({{ $productCount }})
                </button>
                <button class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all whitespace-nowrap">
                    Faol ({{ $userProducts->where('status', 'active')->count() }})
                </button>
                <button class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all whitespace-nowrap">
                    Nofaol ({{ $userProducts->where('status', '!=', 'active')->count() }})
                </button>
            </div>

            @if($userProducts->count() > 0)
                <div class="space-y-3 sm:space-y-4">
                    @foreach($userProducts as $product)
                        <div class="bg-white rounded-2xl border border-gray-200 p-3 sm:p-4 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col sm:flex-row items-stretch gap-3 sm:gap-4 border-l-4 border-l-[#0084ff] group">
                            
                            <!-- Thumbnail Box (Strict Fixed Dimensions for Uniform Image Sizes) -->
                            <div class="relative w-full sm:w-48 h-48 sm:h-44 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                @if(!empty($product->images) && count($product->images) > 0)
                                    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400">
                                        <i class="fa-solid fa-house-chimney text-3xl"></i>
                                    </div>
                                @endif

                                <!-- TOP Badge -->
                                <div class="absolute top-2 left-2 z-10">
                                    <span class="px-2 py-0.5 rounded bg-amber-500 text-white font-black text-[10px] tracking-wider uppercase shadow">
                                        TOP
                                    </span>
                                </div>

                                <!-- Favorite Heart Button -->
                                <div class="absolute top-2 right-2 z-10">
                                    @php $isFav = $product->isFavoritedBy(Auth::user()); @endphp
                                    <button type="button" data-id="{{ $product->id }}" class="js-favorite-btn w-8 h-8 rounded-full bg-white/90 backdrop-blur-md hover:bg-white text-gray-600 flex items-center justify-center text-xs shadow transition-all">
                                        <i class="{{ $isFav ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-gray-500' }}"></i>
                                    </button>
                                </div>

                                <!-- Promo Badge -->
                                <div class="absolute bottom-2 left-2 z-10">
                                    <span class="px-2 py-0.5 rounded bg-amber-500 text-white font-bold text-[10px] shadow">
                                        Yaxshi Taklif
                                    </span>
                                </div>
                            </div>

                            <!-- Right Product Details Column -->
                            <div class="flex-1 min-w-0 flex flex-col justify-between space-y-2">
                                <div class="space-y-1.5">
                                    <!-- Header Row: Title, Badges & Price -->
                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-1 sm:gap-3">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex flex-wrap items-center gap-1.5 mb-1">
                                                <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Faol</span>
                                                <span class="px-1.5 py-0.5 rounded bg-amber-50 text-amber-700 text-[10px] font-bold border border-amber-200">VIP / TOP</span>
                                            </div>
                                            <h4 class="font-display font-bold text-sm sm:text-base text-[#061c3f] group-hover:text-[#0084ff] transition-all leading-snug">
                                                <a href="{{ route('products.show', $product->id) }}" class="hover:underline">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                        </div>

                                        <!-- Price & Time -->
                                        <div class="flex items-baseline sm:flex-col sm:items-end justify-between sm:justify-start flex-shrink-0 mt-1 sm:mt-0">
                                            <div class="font-display font-black text-base sm:text-xl text-amber-500 leading-tight">
                                                {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-bold text-amber-600">y.e</span>
                                            </div>
                                            <span class="text-[11px] text-gray-400 font-medium">
                                                {{ $product->created_at ? $product->created_at->diffForHumans() : '' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Address Location & Rating -->
                                    <div class="flex flex-wrap items-center justify-between gap-1 text-xs text-gray-500">
                                        <p class="truncate flex items-center gap-1 min-w-0">
                                            <i class="fa-solid fa-location-dot text-[#0084ff] flex-shrink-0"></i>
                                            <span>{{ $product->region->name ?? '' }} {{ $product->city ? ', ' . $product->city->name : '' }} {{ $product->landmark ? ', ' . $product->landmark : '' }}</span>
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
                                    <div class="flex flex-wrap items-center gap-1.5 pt-0.5">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-building text-[#0084ff]"></i>
                                            {{ $product->floor ?? 1 }}/{{ $product->building_floor ?? 9 }} etaj
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-door-open text-[#0084ff]"></i>
                                            {{ $product->rooms ?? 1 }} xona
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-ruler-combined text-[#0084ff]"></i>
                                            {{ $product->square ?? 0 }}m²
                                        </span>
                                    </div>
                                </div>

                                <!-- Bottom Line: Tags & Action Buttons -->
                                <div class="pt-2 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <div class="flex items-center gap-1.5 flex-wrap min-w-0">
                                        <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-800 border border-amber-100 text-[11px] font-semibold flex items-center gap-1">
                                            <i class="fa-solid fa-screwdriver-wrench text-amber-500"></i>
                                            {{ $product->repair ?? 'Evro' }}
                                        </span>

                                        @if($product->metros && $product->metros->count() > 0)
                                            <span class="px-2 py-0.5 rounded-md bg-blue-50 text-[#0084ff] border border-blue-100 text-[11px] font-semibold flex items-center gap-1 truncate">
                                                <i class="fa-solid fa-train-subway text-[#0084ff]"></i>
                                                {{ $product->metros->first()->name }} Metro
                                            </span>
                                        @endif

                                        <!-- Private View Counter -->
                                        <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-700 border border-gray-200 text-[11px] font-bold flex items-center gap-1" title="Faqat sizga ko'rinadigan ko'rishlar soni">
                                            <i class="fa-solid fa-eye text-[#0084ff]"></i>
                                            {{ number_format($product->views_count, 0, ',', ' ') }}
                                        </span>
                                    </div>

                                    <!-- Action Buttons Row (Equal Grid on Mobile, Flex on Desktop) -->
                                    <div class="grid grid-cols-3 sm:flex items-center gap-1.5 sm:gap-2 w-full sm:w-auto flex-shrink-0 pt-2 sm:pt-0 border-t border-gray-100 sm:border-t-0">
                                        <a href="{{ route('products.show', $product->id) }}" class="px-2.5 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs transition-all flex items-center justify-center gap-1 text-center">
                                            <i class="fa-solid fa-eye text-[10px]"></i> <span class="hidden xs:inline">Ko'rish</span><span class="xs:hidden">Ko'r</span>
                                        </a>
                                        <a href="{{ route('client.products.edit', $product->id) }}" class="px-2.5 py-1.5 rounded-lg bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-xs transition-all shadow-sm flex items-center justify-center gap-1 text-center">
                                            <i class="fa-solid fa-pen-to-square text-[10px]"></i> <span class="hidden xs:inline">Tahrirlash</span><span class="xs:hidden">Tahrir</span>
                                        </a>
                                        <form action="{{ route('client.products.delete', $product->id) }}" method="POST" class="inline w-full" onsubmit="return confirm('Ushbu e\'lonni o\'chirishga ishonchingiz komilmi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-2.5 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs transition-all flex items-center justify-center gap-1 text-center">
                                                <i class="fa-solid fa-trash text-[10px]"></i> <span class="hidden xs:inline">O'chirish</span><span class="xs:hidden">O'chir</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-4">
                    <i class="fa-regular fa-folder-open text-gray-400 text-3xl sm:text-4xl mb-3 block"></i>
                    <h4 class="font-semibold text-gray-700 text-xs sm:text-sm mb-1">Hozircha hech qanday e'lonlar joylashtirilmagan</h4>
                    <p class="text-xs text-gray-400 max-w-xs mx-auto mb-4">Uyingizni sotish yoki ijaraga berish uchun birinchi e'loningizni qo'shing.</p>
                    <a href="{{ route('client.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0084ff] text-white rounded-xl font-bold text-xs shadow hover:bg-[#0076e5] transition-all">
                        <i class="fa-solid fa-plus"></i> Birinchi e'lonni berish
                    </a>
                </div>
            @endif

        @else
            <!-- FAVORITE ANNOUNCEMENTS SECTION -->
            @if($favoriteProducts->count() > 0)
                <div class="space-y-3 sm:space-y-4">
                    @foreach($favoriteProducts as $product)
                        <div class="bg-white rounded-2xl border border-gray-200 p-3 sm:p-4 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col sm:flex-row items-stretch gap-3 sm:gap-4 border-l-4 border-l-red-500 group">
                            
                            <!-- Thumbnail Box (Strict Fixed Dimensions for Uniform Image Sizes) -->
                            <div class="relative w-full sm:w-48 h-48 sm:h-44 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                @if(!empty($product->images) && count($product->images) > 0)
                                    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400">
                                        <i class="fa-solid fa-house-chimney text-3xl"></i>
                                    </div>
                                @endif

                                <!-- Favorite Heart Button -->
                                <div class="absolute top-2 right-2 z-10">
                                    <button type="button" data-id="{{ $product->id }}" class="js-favorite-btn w-8 h-8 rounded-full bg-white/90 backdrop-blur-md hover:bg-white text-red-500 flex items-center justify-center text-xs shadow transition-all" title="Saralanganlardan chiqarish">
                                        <i class="fa-solid fa-heart text-red-500"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Right Product Details Column -->
                            <div class="flex-1 min-w-0 flex flex-col justify-between space-y-2">
                                <div class="space-y-1.5">
                                    <!-- Header Row: Title & Price -->
                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-1 sm:gap-3">
                                        <div class="min-w-0 flex-1">
                                            <span class="px-1.5 py-0.5 rounded bg-red-50 text-red-600 text-[10px] font-bold border border-red-200 inline-block mb-1">
                                                <i class="fa-solid fa-heart mr-1"></i> Saralangan
                                            </span>
                                            <h4 class="font-display font-bold text-sm sm:text-base text-[#061c3f] group-hover:text-[#0084ff] transition-all leading-snug">
                                                <a href="{{ route('products.show', $product->id) }}" class="hover:underline">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                        </div>

                                        <!-- Price & Time -->
                                        <div class="flex items-baseline sm:flex-col sm:items-end justify-between sm:justify-start flex-shrink-0 mt-1 sm:mt-0">
                                            <div class="font-display font-black text-base sm:text-xl text-amber-500 leading-tight">
                                                {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-bold text-amber-600">y.e</span>
                                            </div>
                                            <span class="text-[11px] text-gray-400 font-medium">
                                                {{ $product->created_at ? $product->created_at->diffForHumans() : '' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Address Location -->
                                    <div class="flex flex-wrap items-center justify-between gap-1 text-xs text-gray-500">
                                        <p class="truncate flex items-center gap-1 min-w-0">
                                            <i class="fa-solid fa-location-dot text-[#0084ff] flex-shrink-0"></i>
                                            <span>{{ $product->region->name ?? '' }} {{ $product->city ? ', ' . $product->city->name : '' }} {{ $product->landmark ? ', ' . $product->landmark : '' }}</span>
                                        </p>
                                    </div>

                                    <!-- Specs Pills (Etaj, Xona, m²) -->
                                    <div class="flex flex-wrap items-center gap-1.5 pt-0.5">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-building text-[#0084ff]"></i>
                                            {{ $product->floor ?? 1 }}/{{ $product->building_floor ?? 9 }} etaj
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-door-open text-[#0084ff]"></i>
                                            {{ $product->rooms ?? 1 }} xona
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50/80 text-[#061c3f] font-bold text-xs border border-blue-100">
                                            <i class="fa-solid fa-ruler-combined text-[#0084ff]"></i>
                                            {{ $product->square ?? 0 }}m²
                                        </span>
                                    </div>
                                </div>

                                <!-- Bottom Line: Action Buttons -->
                                <div class="pt-2 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                    <div class="flex items-center gap-1.5 flex-wrap min-w-0">
                                        <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-800 border border-amber-100 text-[11px] font-semibold flex items-center gap-1">
                                            <i class="fa-solid fa-screwdriver-wrench text-amber-500"></i>
                                            {{ $product->repair ?? 'Evro' }}
                                        </span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="grid grid-cols-2 sm:flex items-center gap-1.5 sm:gap-2 w-full sm:w-auto flex-shrink-0 pt-2 sm:pt-0 border-t border-gray-100 sm:border-t-0">
                                        <a href="{{ route('products.show', $product->id) }}" class="px-3 py-1.5 rounded-lg bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-xs transition-all flex items-center justify-center gap-1 text-center">
                                            <i class="fa-solid fa-eye text-[10px]"></i> Ko'rish
                                        </a>
                                        <button type="button" data-id="{{ $product->id }}" class="js-favorite-btn px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-xs transition-all flex items-center justify-center gap-1 text-center">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i> O'chirish
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 sm:py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-4">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center text-xl sm:text-2xl mx-auto mb-3">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <h4 class="font-semibold text-gray-700 text-xs sm:text-base mb-1">Hozircha saralangan e'lonlar mavjud emas</h4>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto mb-4">
                        Uylarni ko'rayotganda yurakcha tugmasini bosib, o'zingizga ma'qul kelgan e'lonlarni bu yerga saqlab qo'yishingiz mumkin.
                    </p>
                    <a href="/" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0084ff] text-white rounded-xl font-bold text-xs shadow hover:bg-[#0076e5] transition-all">
                        <i class="fa-solid fa-magnifying-glass"></i> Uylarni qidirish
                    </a>
                </div>
            @endif
        @endif

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';

    document.querySelectorAll('.js-favorite-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const productId = this.dataset.id;
            if(!productId) return;

            fetch('/favorites/toggle/' + productId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => {
                if (res.status === 401) {
                    window.location.href = '{{ route("login") }}';
                    return;
                }
                return res.json();
            })
            .then(data => {
                if(data && data.success) {
                    const icon = this.querySelector('i');
                    if (data.is_favorited) {
                        if (icon) icon.className = 'fa-solid fa-heart text-red-500';
                        this.classList.add('text-red-500');
                    } else {
                        if (icon) icon.className = 'fa-regular fa-heart text-gray-500';
                        this.classList.remove('text-red-500');
                    }

                    if (window.location.search.includes('section=favorites')) {
                        window.location.reload();
                    }
                }
            })
            .catch(err => console.error('Favorite toggle error:', err));
        });
    });
});
</script>
@endsection
