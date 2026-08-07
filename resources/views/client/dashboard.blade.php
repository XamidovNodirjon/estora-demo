@extends('layouts.client')

@section('title', 'Makler Admin Paneli')

@section('content')
<div class="flex flex-col lg:flex-row gap-5 items-start w-full">

    <!-- ================= COLUMN 1: LEFT SIDEBAR NAVIGATION ================= -->
    <aside class="w-full lg:w-60 flex-shrink-0 space-y-4">
        
        <!-- Main Vertical Navigation Box -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-3 shadow-xs space-y-1">
            
            <!-- 1. Bosh sahifa -->
            <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" 
               class="{{ $section === 'my_products' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-house-chimney text-base"></i>
                    <span>Bosh sahifa</span>
                </div>
            </a>

            <!-- 2. E'lonlarim -->
            <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" 
               class="{{ $section === 'my_products' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-folder-open text-base {{ $section === 'my_products' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>E'lonlarim</span>
                </div>
                <span class="{{ $section === 'my_products' ? 'bg-white text-blue-600' : 'bg-blue-600 text-white' }} font-extrabold text-[11px] px-2 py-0.5 rounded-full">{{ $productCount }}</span>
            </a>

            <!-- 3. Chatlar -->
            <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" 
               class="{{ $section === 'chats' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-comments text-base {{ $section === 'chats' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Chatlar</span>
                </div>
            </a>

            <!-- 4. Statistika (NEW DEDICATED STATS PAGE) -->
            <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" 
               class="{{ $section === 'stats' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-chart-line text-base {{ $section === 'stats' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Statistika</span>
                </div>
            </a>

            <!-- 5. Obuna va to'lovlar -->
            <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" 
               class="{{ $section === 'subscription' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-credit-card text-base {{ $section === 'subscription' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Obuna va to'lovlar</span>
                </div>
            </a>

            <!-- 6. Mening sahifam -->
            <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" 
               class="{{ $section === 'my_page' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-globe text-base {{ $section === 'my_page' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Mening sahifam</span>
                </div>
            </a>

            <!-- 7. Yangiliklar -->
            <a href="{{ route('client.dashboard', ['section' => 'news']) }}" 
               class="{{ $section === 'news' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-bell text-base {{ $section === 'news' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Yangiliklar</span>
                </div>
            </a>

            <!-- 8. Sozlamalar -->
            <a href="{{ route('client.dashboard', ['section' => 'settings']) }}" 
               class="{{ $section === 'settings' ? 'bg-[#0066FF] text-white font-extrabold shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-bold' }} rounded-xl px-3.5 py-2.5 flex items-center justify-between text-xs sm:text-sm transition-all">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-sliders text-base {{ $section === 'settings' ? 'text-white' : 'text-slate-400' }}"></i>
                    <span>Sozlamalar</span>
                </div>
            </a>

        </div>

        <!-- Left Sidebar PRO Subscription Card -->
        <div class="bg-gradient-to-br from-blue-50/70 to-slate-50 border border-blue-100/90 rounded-2xl p-4 space-y-2 shadow-xs">
            <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-500 flex items-center justify-center text-lg">
                <i class="fa-solid fa-crown"></i>
            </div>
            <div class="space-y-0.5">
                <h4 class="font-black text-slate-900 text-sm">PRO obuna</h4>
                <p class="text-xs font-bold text-slate-600">17 kun qoldi</p>
                <p class="text-[11px] text-slate-400 font-medium">25.05.2025 da tugaydi</p>
            </div>
            <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="w-full bg-[#0066FF] hover:bg-blue-700 text-white font-extrabold text-xs py-2 rounded-xl transition-all block text-center shadow-xs mt-3">
                Obunani uzaytirish
            </a>
            <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="text-xs font-bold text-blue-600 hover:underline block text-center pt-1">
                Tariflar haqida &rarr;
            </a>
        </div>

    </aside>


    <!-- ================= COLUMN 2: CENTER MAIN CONTENT ================= -->
    <main class="flex-1 min-w-0 space-y-5">

        @if($section === 'stats')
            <!-- ================= STATISTIKA SAHIFASI (NEW DEDICATED STATS VIEW) ================= -->
            <div class="space-y-5">
                
                <!-- Stats Header -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-100 text-blue-700 text-xs font-extrabold px-2.5 py-0.5 rounded-md border border-blue-200">
                                <i class="fa-solid fa-chart-line mr-1"></i> Ko'rishlar Analitikasi
                            </span>
                        </div>
                        <h2 class="font-black text-2xl text-slate-900 tracking-tight mt-1">E'lonlar Ko'rishlar Statistikasi</h2>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Har bir ko'chmas mulk ob'yekti bo'yicha ko'rishlar soni va statistikasi</p>
                    </div>

                    <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>E'lonlarimga qaytish</span>
                    </a>
                </div>

                <!-- 4 Overview Stat Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Card 1: Jami Ko'rishlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Jami Ko'rishlar</span>
                            <h3 class="font-black text-2xl text-slate-900 mt-0.5">{{ number_format($totalViews, 0, '', ' ') }}</h3>
                        </div>
                    </div>

                    <!-- Card 2: Faol E'lonlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Faol E'lonlar</span>
                            <h3 class="font-black text-2xl text-slate-900 mt-0.5">{{ $userProducts->where('status', 'active')->count() }} ta</h3>
                        </div>
                    </div>

                    <!-- Card 3: O'rtacha Ko'rishlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">O'rtacha Ko'rish</span>
                            <h3 class="font-black text-2xl text-slate-900 mt-0.5">{{ $avgViews }} ta</h3>
                        </div>
                    </div>

                    <!-- Card 4: Eng Ko'p Ko'rilgan -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-fire"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Top E'lon</span>
                            <h3 class="font-extrabold text-sm text-slate-900 mt-0.5 truncate">
                                {{ $topViewedProduct ? $topViewedProduct->name : "Hozircha yo'q" }}
                            </h3>
                            @if($topViewedProduct)
                                <span class="text-xs font-extrabold text-amber-600">
                                    {{ $topViewedProduct->views->count() }} ko'rish
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Weekly Views Chart Visualization -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h4 class="font-extrabold text-slate-900 text-base flex items-center gap-2">
                            <i class="fa-solid fa-chart-area text-blue-600"></i>
                            <span>Haftalik Ko'rishlar Dinamikasi</span>
                        </h4>
                        <span class="text-xs font-bold text-slate-400">Joriy hafta</span>
                    </div>

                    <!-- Chart Bars -->
                    <div class="h-48 flex items-end justify-between gap-3 pt-6 px-4 border-b border-slate-100">
                        @php
                            $days = [
                                ['day' => 'Dushanba', 'count' => 12, 'height' => 'h-24'],
                                ['day' => 'Seshanba', 'count' => 18, 'height' => 'h-32'],
                                ['day' => 'Chorshanba', 'count' => 24, 'height' => 'h-40'],
                                ['day' => 'Payshanba', 'count' => 15, 'height' => 'h-28'],
                                ['day' => 'Juma', 'count' => 30, 'height' => 'h-44'],
                                ['day' => 'Shanba', 'count' => 22, 'height' => 'h-36'],
                                ['day' => 'Yakshanba', 'count' => 14, 'height' => 'h-24'],
                            ];
                        @endphp

                        @foreach($days as $item)
                            <div class="flex-1 flex flex-col items-center gap-2 group">
                                <span class="text-[11px] font-black text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{ $item['count'] }}
                                </span>
                                <div class="w-full bg-blue-100 group-hover:bg-blue-600 rounded-t-xl transition-all duration-300 {{ $item['height'] }}"></div>
                                <span class="text-[11px] font-bold text-slate-500 truncate">{{ $item['day'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Har bir e'lon bo'yicha Ko'rishlar Ro'yxati -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h4 class="font-extrabold text-slate-900 text-base">E'lonlar Bo'yicha Ko'rishlar Statistikasi</h4>
                        <span class="text-xs font-bold text-blue-600">{{ $productCount }} ta e'lon</span>
                    </div>

                    <div class="space-y-3">
                        @forelse($userProducts as $product)
                            @php
                                $viewsCount = $product->views->count();
                                $percentage = $totalViews > 0 ? min(100, round(($viewsCount / $totalViews) * 100)) : 0;
                            @endphp
                            <div class="border border-slate-200/80 rounded-xl p-4 hover:border-blue-300 transition-all space-y-2">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                            @if(!empty($product->images) && is_array($product->images) && count($product->images) > 0)
                                                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="/images/apartment1.png" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>

                                        <div class="min-w-0">
                                            <h5 class="font-extrabold text-slate-900 text-sm truncate">{{ $product->name }}</h5>
                                            <p class="text-xs text-slate-400 font-medium">
                                                {{ $product->city->name_uz ?? ($product->region->name_uz ?? 'Toshkent') }} &middot; {{ number_format($product->price, 0, '', ' ') }} so'm
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4 flex-shrink-0">
                                        <div class="text-right">
                                            <span class="block text-xs font-bold text-slate-400">Ko'rishlar</span>
                                            <span class="text-base font-black text-blue-600 flex items-center gap-1 justify-end">
                                                <i class="fa-regular fa-eye text-xs"></i> {{ $viewsCount }} ta
                                            </span>
                                        </div>

                                        <a href="{{ route('products.show', $product->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Ko'rish">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Progress Bar Share -->
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-blue-600 h-full rounded-full transition-all duration-500" style="width: {{ max(5, $percentage) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-400 text-xs font-medium">
                                Hozircha e'lonlaringiz statistikasi mavjud emas.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        @elseif($section === 'chats')
            <!-- ================= CHATLAR SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                        <i class="fa-regular fa-comments text-blue-600"></i>
                        <span>Chatlar va Mijozlar Muloqoti</span>
                    </h2>
                    <span class="bg-red-500 text-white font-extrabold text-xs px-2.5 py-0.5 rounded-full">3 ta yangi</span>
                </div>
                
                <div class="text-center py-12 space-y-3">
                    <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mx-auto">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-base">Chatlar Bo'limi Active</h4>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto">
                        Mijozlariz bilan to'g'ridan-to'g'ri xabarlashing va savollarga tezkor javob bering.
                    </p>
                </div>
            </div>

        @elseif($section === 'subscription')
            <!-- ================= OBUNA VA TO'LOVLAR SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                        <i class="fa-regular fa-credit-card text-blue-600"></i>
                        <span>Obuna va To'lovlar</span>
                    </h2>
                    <span class="bg-amber-500 text-white font-black text-xs px-3 py-1 rounded-md">PRO STATUS</span>
                </div>

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white space-y-3">
                    <span class="bg-white/20 text-white font-bold text-xs px-3 py-1 rounded-full">Faol Tarif</span>
                    <h3 class="font-black text-2xl">Rieltor PRO Obuna</h3>
                    <p class="text-xs text-blue-100">Cheksiz e'lon joylash va VIP tavsiya xizmatlari</p>
                    <div class="pt-2 flex items-center gap-3">
                        <button class="bg-white text-blue-600 font-extrabold text-xs px-4 py-2 rounded-xl shadow-xs">
                            Obunani uzaytirish
                        </button>
                    </div>
                </div>
            </div>

        @elseif($section === 'my_page')
            <!-- ================= MENING SAHIFAM SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="border-b border-slate-100 pb-3">
                    <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-globe text-blue-600"></i>
                        <span>Mening Shaxsiy Sahifam</span>
                    </h2>
                    <p class="text-xs text-slate-400 font-medium">Shaxsiy rieltorlik sahifangiz barcha e'lonlaringizni ko'rsatadi</p>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-3">
                    <label class="text-xs font-bold text-slate-700 block">Sizning Sahifa Havolangiz:</label>
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl p-2 pl-3 shadow-xs">
                        <span class="text-xs font-bold text-blue-600 truncate flex-1">estorqa.uz/makler/{{ Str::slug(Auth::user()->name ?? 'akmaljon') }}</span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs px-4 py-2 rounded-lg shadow-xs transition-all">
                            Nusxalash
                        </button>
                    </div>
                </div>
            </div>

        @elseif($section === 'news')
            <!-- ================= YANGILIKLAR SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="border-b border-slate-100 pb-3">
                    <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                        <i class="fa-regular fa-bell text-blue-600"></i>
                        <span>Yangiliklar va Bildirishnomalar</span>
                    </h2>
                </div>

                <div class="space-y-3">
                    <div class="p-4 rounded-xl bg-blue-50 border border-blue-100 flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-blue-600 text-lg mt-0.5"></i>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Yangi funksiyalar ishga tushirildi!</h4>
                            <p class="text-xs text-slate-600 mt-0.5">Statistika bo'limida e'lonlaringiz ko'rishlar sonini kuzatishingiz mumkin.</p>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($section === 'settings')
            <!-- ================= SOZLAMALAR SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="border-b border-slate-100 pb-3">
                    <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-blue-600"></i>
                        <span>Profil Sozlamalari</span>
                    </h2>
                </div>

                <form class="space-y-4 max-w-lg">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ism va Familiya</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2 px-3 text-xs font-bold text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Telefon raqam</label>
                        <input type="text" value="{{ Auth::user()->phone ?? '+998 90 123 45 67' }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2 px-3 text-xs font-bold text-slate-800">
                    </div>

                    <button type="button" class="bg-blue-600 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-xs">
                        Saqlash
                    </button>
                </form>
            </div>

        @else
            <!-- ================= DEFAULT MAIN DASHBOARD & E'LONLARIM VIEW ================= -->
            
            <!-- 1. HERO WELCOME BANNER WITH HOUSE GRAPHIC -->
            <div class="bg-[#0B1A30] rounded-2xl p-6 sm:p-7 relative overflow-hidden text-white shadow-md border border-slate-800/80">
                
                <!-- Right side house graphic image -->
                <img src="/images/hero.png" alt="Luxury House" class="absolute right-0 bottom-0 top-0 h-full w-2/5 md:w-1/2 object-cover object-left opacity-90 hidden sm:block pointer-events-none">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0B1A30] via-[#0B1A30]/95 to-transparent z-10 pointer-events-none"></div>

                <div class="relative z-20 space-y-5 max-w-xl">
                    <div>
                        <h2 class="font-black text-2xl sm:text-3xl text-white tracking-tight leading-tight">
                            Xush kelibsiz, {{ Auth::user()->name ?? 'Akmaljon' }}!
                        </h2>
                        <p class="text-slate-300 text-xs sm:text-sm font-medium mt-1">
                            Bugun ham samarali kun tilaymiz.
                        </p>
                    </div>

                    <!-- View Count Statistics Cards Row (FAQT VIEW COUNT) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 max-w-md">
                        
                        <!-- Stat 1: Jami ko'rishlar (Total Views) -->
                        <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 rounded-xl p-3 flex items-center gap-3 hover:border-blue-500 transition-all group">
                            <div class="w-10 h-10 rounded-lg bg-blue-600/30 text-blue-400 flex items-center justify-center text-base flex-shrink-0 border border-blue-500/30 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                <i class="fa-regular fa-eye"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[11px] text-slate-300 font-semibold block leading-tight truncate">Jami ko'rishlar soni</span>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="text-xl font-black text-white">{{ $totalViews }}</span>
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-400 font-extrabold px-1.5 py-0.2 rounded border border-emerald-500/30">Ko'rishlar</span>
                                </div>
                            </div>
                        </a>

                        <!-- Stat 2: Mening e'lonlarim soni -->
                        <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700/60 rounded-xl p-3 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-800/90 text-slate-300 flex items-center justify-center text-base flex-shrink-0">
                                <i class="fa-regular fa-folder-open"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[11px] text-slate-300 font-semibold block leading-tight truncate">Mening e'lonlarim</span>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="text-xl font-black text-white">{{ $productCount }} ta</span>
                                    <span class="text-[10px] bg-blue-500/20 text-blue-400 font-extrabold px-1.5 py-0.2 rounded border border-blue-500/30">Faol</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- 2. QUICK ACTION CARDS (4 HORIZONTAL CARDS) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3.5">
                
                <!-- Quick Action 1 -->
                <a href="{{ route('client.products.create') }}" class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center text-sm shadow-xs group-hover:scale-105 transition-transform flex-shrink-0">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">Yangi e'lon joylash</h4>
                        <p class="text-[11px] text-slate-400 font-medium truncate">Sotuv yoki ijara e'lonini yarating</p>
                    </div>
                </a>

                <!-- Quick Action 2 -->
                <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">Mening sahifam</h4>
                        <p class="text-[11px] text-slate-400 font-medium truncate">Shaxsay sahifangizni ulashing</p>
                    </div>
                </a>

                <!-- Quick Action 3 -->
                <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">Statistikam</h4>
                        <p class="text-[11px] text-slate-400 font-medium truncate">E'lonlar statistikasini ko'rish</p>
                    </div>
                </a>

                <!-- Quick Action 4 -->
                <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-sm flex-shrink-0">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">Chatlar</h4>
                        <p class="text-[11px] text-slate-400 font-medium truncate">Mijozlar bilan suhbatlashing</p>
                    </div>
                </a>

            </div>


            <!-- 3. E'LONLARIM SECTION (ONLY AUTHOR'S OWN ANNOUNCEMENTS) -->
            <div class="space-y-4">
                
                <!-- Section Header -->
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-xl text-slate-900">Mening E'lonlarim</h3>
                        <p class="text-xs text-slate-400 font-medium">Faqat o'zingiz joylashtirgan e'lonlar ro'yxati</p>
                    </div>
                    <a href="{{ route('client.products.create') }}" class="text-xs font-extrabold bg-blue-600 hover:bg-blue-700 text-white px-3.5 py-2 rounded-xl flex items-center gap-1.5 shadow-xs transition-all">
                        <i class="fa-solid fa-plus"></i>
                        <span>Yangi e'lon</span>
                    </a>
                </div>

                <!-- Status Category Filter Tabs -->
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                    <button class="bg-[#0066FF] text-white font-extrabold text-xs px-4 py-2 rounded-xl shadow-xs whitespace-nowrap">
                        Barchasi ({{ $productCount }})
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-700 font-bold text-xs px-4 py-2 rounded-xl hover:bg-slate-50 transition-all whitespace-nowrap">
                        Faol ({{ $userProducts->where('status', 'active')->count() }})
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-700 font-bold text-xs px-4 py-2 rounded-xl hover:bg-slate-50 transition-all whitespace-nowrap">
                        Nofaol ({{ $userProducts->where('status', '!=', 'active')->count() }})
                    </button>
                </div>

                <!-- Search & Filters Bar -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                    <div class="flex-1 relative">
                        <input type="text" 
                               placeholder="E'lon nomi yoki ID bo'yicha qidirish..." 
                               class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-9 pr-4 text-xs font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:border-blue-600 shadow-xs">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>

                    <div class="flex items-center gap-2">
                        <select class="bg-white border border-slate-200 rounded-xl px-3.5 py-2 text-xs font-bold text-slate-700 focus:outline-none shadow-xs">
                            <option>Barcha tur</option>
                            <option>Sotuv</option>
                            <option>Ijara</option>
                        </select>

                        <button class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-xs flex items-center gap-1.5 transition-all">
                            <i class="fa-solid fa-sliders text-slate-400"></i>
                            <span>Filtrlar</span>
                        </button>
                    </div>
                </div>


                <!-- LISTING CARDS (DYNAMICALLY LOOPS OVER ONLY LOGGED IN USER'S OWN PRODUCTS) -->
                <div class="space-y-4">
                    
                    @forelse($userProducts as $product)
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all space-y-3">
                            
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                                
                                <!-- Left Thumbnail -->
                                <div class="relative w-full sm:w-44 h-32 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    @if(!empty($product->images) && is_array($product->images) && count($product->images) > 0)
                                        <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="/images/apartment1.png" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @endif

                                    @if($loop->first)
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-amber-400 text-amber-950 font-black text-[10px] px-2 py-0.5 rounded shadow-xs uppercase tracking-wider">TOP</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Middle Info -->
                                <div class="flex-1 min-w-0 space-y-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if(($product->status ?? 'active') === 'active')
                                            <span class="bg-emerald-100 text-emerald-700 font-extrabold text-[11px] px-2.5 py-0.5 rounded-md border border-emerald-200">Faol</span>
                                        @else
                                            <span class="bg-slate-100 text-slate-600 font-extrabold text-[11px] px-2.5 py-0.5 rounded-md border border-slate-200">Nofaol</span>
                                        @endif

                                        <span class="text-xs text-slate-400 font-semibold flex items-center gap-1">
                                            <i class="fa-regular fa-clock"></i> {{ $product->created_at ? $product->created_at->diffForHumans() : 'Yangi' }}
                                        </span>
                                    </div>

                                    <h4 class="font-black text-slate-900 text-base hover:text-blue-600 transition-colors">
                                        <a href="{{ route('products.show', $product->id) }}" class="hover:underline">
                                            {{ $product->name }}
                                        </a>
                                    </h4>

                                    <div class="flex items-center gap-3 text-xs text-slate-500 flex-wrap">
                                        <span class="flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot text-slate-400"></i> 
                                            {{ $product->city->name_uz ?? ($product->region->name_uz ?? ($product->landmark ?? 'Toshkent shahar')) }}
                                        </span>
                                        <span class="text-slate-300">&bull;</span>
                                        <span class="font-semibold text-slate-500">
                                            {{ $product->category->name_uz ?? 'Kvartira' }}
                                        </span>
                                    </div>

                                    <div class="font-black text-slate-900 text-lg pt-0.5">
                                        {{ number_format($product->price, 0, '', ' ') }} so'm
                                    </div>

                                    <!-- Metric Row: FAQAT VIEW COUNT (Ko'rishlar soni) -->
                                    <div class="flex items-center gap-4 text-xs text-slate-500 pt-1 flex-wrap">
                                        <span class="flex items-center gap-1.5 font-bold text-slate-800 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                                            <i class="fa-regular fa-eye text-blue-600 text-sm"></i> 
                                            <span>Ko'rishlar soni: <strong>{{ $product->views->count() }}</strong></span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Actions -->
                                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                    <a href="{{ route('client.products.edit', $product->id) }}" class="border border-blue-400 text-blue-600 hover:bg-blue-50 font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition-all flex items-center gap-1.5 shadow-xs w-full sm:w-auto justify-center">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span>Tahrirlash</span>
                                    </a>

                                    <form action="{{ route('client.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('E\'lonni o\'chirishni tasdiqlaysizmi?')" class="w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border border-red-200 text-red-600 hover:bg-red-50 font-extrabold text-xs px-3.5 py-1.5 rounded-xl transition-all flex items-center gap-1.5 shadow-xs w-full justify-center">
                                            <i class="fa-regular fa-trash-can"></i>
                                            <span>O'chirish</span>
                                        </button>
                                    </form>
                                </div>

                            </div>

                            <!-- Bottom Price Recommendation Bar -->
                            <div class="bg-slate-50/90 border border-slate-200/80 rounded-xl px-4 py-2 flex flex-wrap items-center justify-between gap-2 text-xs">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-slate-600 font-medium">Tavsiya etilgan narx: <strong>{{ number_format($product->price * 0.95, 0, '', ' ') }} &ndash; {{ number_format($product->price * 1.05, 0, '', ' ') }} so'm</strong></span>
                                    <span class="bg-emerald-100 text-emerald-700 font-extrabold text-[11px] px-2.5 py-0.5 rounded-md border border-emerald-200">Narx mos</span>
                                </div>
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 font-extrabold hover:underline flex items-center gap-1">
                                    <span>Tafsilotlarni ko'rish</span>
                                    <i class="fa-solid fa-chevron-right text-[9px]"></i>
                                </a>
                            </div>

                        </div>
                    @empty
                        <!-- Empty State Card when user has no announcements yet -->
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-8 shadow-xs text-center space-y-3">
                            <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mx-auto border border-blue-100">
                                <i class="fa-regular fa-folder-open"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-base">Hozircha o'zingizning e'lonlaringiz mavjud emas</h4>
                            <p class="text-xs text-slate-500 max-w-md mx-auto font-medium">
                                Siz hali hech qanday ko'chmas mulk e'lonini joylashtirmadingiz. Yangi e'lon berish tugmasini bosib birinchi e'loningizni qo'shing.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('client.products.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-xs transition-all">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Birinchi e'loningizni joylashtiring</span>
                                </a>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>
        @endif

    </main>


    <!-- ================= COLUMN 3: RIGHT SIDEBAR ================= -->
    <aside class="w-full lg:w-72 xl:w-80 flex-shrink-0 space-y-4">
        
        <!-- CARD 1: MAKLER PROFILE CARD -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs text-center space-y-4 relative">
            
            <!-- Avatar photo with verified checkmark -->
            <div class="relative w-20 h-20 mx-auto">
                <img src="/images/avatar_akmaljon.jpg" alt="Akmaljon Makler" class="w-20 h-20 rounded-full object-cover ring-4 ring-slate-100 shadow-md">
                <div class="absolute right-0 bottom-0 bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ring-2 ring-white shadow-xs" title="Verified Makler">
                    <i class="fa-solid fa-check"></i>
                </div>
            </div>

            <div>
                <h3 class="font-black text-slate-900 text-base flex items-center justify-center gap-1.5">
                    <span>{{ Auth::user()->name ?? 'Akmaljon Makler' }}</span>
                    <i class="fa-solid fa-circle-check text-blue-600 text-sm" title="Verified"></i>
                </h3>

                <div class="text-xs font-bold text-slate-600 mt-1">
                    <span class="text-amber-500">★</span> <strong>4.9</strong> <span class="text-slate-400">(128 ta baho)</span>
                </div>
            </div>

            <!-- Key-Value Info Rows -->
            <div class="space-y-2.5 border-t border-b border-slate-100 py-3 text-xs text-left">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 font-medium">Ishonch darajasi</span>
                    <span class="font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200 inline-flex items-center gap-1">
                        <i class="fa-solid fa-shield-check text-[10px]"></i> Yuqori
                    </span>
                </div>
            </div>

            <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 font-extrabold text-xs py-2.5 rounded-xl transition-all block text-center shadow-xs">
                Profilni ko'rish
            </a>
        </div>


        <!-- CARD 2: OBUNA HOLATI -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs space-y-3">
            <h4 class="font-extrabold text-slate-900 text-sm">Obuna holati</h4>

            <div class="flex items-center justify-between">
                <span class="bg-amber-500 text-white font-black text-[11px] px-2.5 py-0.5 rounded-md uppercase tracking-wider">PRO</span>
                <span class="text-xs font-bold text-slate-700">17 kun qoldi</span>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden mt-1">
                <div class="bg-blue-600 h-full rounded-full w-[80%]"></div>
            </div>
            <p class="text-[11px] text-slate-400 font-medium">25.05.2025 da tugaydi</p>

            <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="w-full bg-blue-50/80 hover:bg-blue-100 text-blue-600 font-extrabold text-xs py-2 rounded-xl transition-all text-center block mt-1">
                Obunani uzaytirish
            </a>

            <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="text-xs font-bold text-blue-600 hover:underline block text-left">
                Tariflar haqida &rarr;
            </a>
        </div>


        <!-- CARD 3: DAROMADIM -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs space-y-3">
            <div class="flex items-center justify-between">
                <h4 class="font-extrabold text-slate-900 text-sm">Daromadim</h4>
                <select class="bg-slate-50 border border-slate-200 rounded-lg text-xs px-2 py-1 font-bold text-slate-700 focus:outline-none shadow-xs">
                    <option>Joriy oy</option>
                    <option>O'tgan oy</option>
                    <option>Shu yil</option>
                </select>
            </div>

            <div class="font-black text-slate-900 text-2xl tracking-tight my-1">
                23 450 000 so'm
            </div>

            <div class="space-y-2 text-xs text-slate-600 pt-1 border-t border-slate-100">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 font-medium">Sotuvdan</span>
                    <strong class="font-extrabold text-slate-900">18 200 000 so'm</strong>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 font-medium">Ijaradan</span>
                    <strong class="font-extrabold text-slate-900">5 250 000 so'm</strong>
                </div>
            </div>

            <a href="{{ route('client.dashboard', ['section' => 'stats']) }}" class="text-xs font-bold text-blue-600 hover:underline block pt-1">
                Batafsil statistika &rarr;
            </a>
        </div>


        <!-- CARD 4: MENING SAHIFAM SHARE CARD -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs space-y-3">
            <h4 class="font-extrabold text-slate-900 text-sm">Mening sahifam</h4>
            <p class="text-xs text-slate-500 leading-relaxed font-medium">
                Mijozlaringiz sizning e'lonlaringizni shu sahifa orqali ko'rishadi.
            </p>

            <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl p-2 pl-3">
                <span class="text-xs font-bold text-blue-600 truncate flex-1">estorqa.uz/makler/{{ Str::slug(Auth::user()->name ?? 'akmaljon') }}</span>
                <button type="button" class="p-1.5 text-slate-400 hover:text-slate-700 bg-white rounded-lg border border-slate-200 shadow-xs cursor-pointer" title="Nusxalash">
                    <i class="fa-regular fa-copy"></i>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-2 pt-1">
                <button class="border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-2 shadow-xs transition-all">
                    <i class="fa-solid fa-qrcode text-slate-500"></i>
                    <span>QR kod</span>
                </button>

                <button class="border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-2 shadow-xs transition-all">
                    <i class="fa-solid fa-share-nodes text-slate-500"></i>
                    <span>Ulashish</span>
                </button>
            </div>
        </div>

    </aside>

</div>
@endsection
