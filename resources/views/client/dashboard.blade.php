@extends('layouts.client')

@section('title', 'Makler Admin Paneli')

@section('content')
<div class="flex flex-col lg:flex-row gap-5 items-start w-full min-w-0 max-w-full">

    <!-- ================= COLUMN 1: LEFT SIDEBAR NAVIGATION ================= -->
    <aside class="w-full lg:w-60 flex-shrink-0 space-y-4 hidden lg:block">
        
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
                @if(isset($unreadNotificationCount) && $unreadNotificationCount > 0)
                    <span class="bg-red-500 text-white font-extrabold text-[11px] px-2 py-0.5 rounded-full animate-pulse">{{ $unreadNotificationCount }}</span>
                @endif
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

            <!-- 9. Profildan Chiqish (Logout) -->
            <div class="pt-2 border-t border-slate-100 mt-2">
                <button type="button" onclick="openLogoutConfirmModal()" class="w-full text-red-600 hover:bg-red-50 font-bold rounded-xl px-3.5 py-2.5 flex items-center gap-3 text-xs sm:text-sm transition-all cursor-pointer text-left">
                    <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                    <span>Profildan chiqish</span>
                </button>
            </div>

        </div>

    </aside>


    <!-- ================= COLUMN 2: CENTER MAIN CONTENT ================= -->
    <main class="flex-1 min-w-0 space-y-5">

        @if($section === 'stats')
            <!-- ================= STATISTIKA SAHIFASI (RESPONSIVE & DEDICATED STATS VIEW) ================= -->
            <div class="space-y-4 sm:space-y-5">
                
                <!-- Stats Header -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-6 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3.5 sm:gap-4">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-50 text-blue-700 text-[11px] sm:text-xs font-extrabold px-2.5 py-0.5 rounded-lg border border-blue-100 flex items-center gap-1.5">
                                <i class="fa-solid fa-chart-line text-blue-600"></i> Ko'rishlar Analitikasi
                            </span>
                            <span class="text-xs font-semibold text-slate-400">&bull;</span>
                            <span class="text-xs font-bold text-slate-500">Real-vaqt hisoboti</span>
                        </div>
                        <h2 class="font-black text-xl sm:text-2xl text-slate-900 tracking-tight mt-1.5 truncate">
                            E'lonlar Ko'rishlar Statistikasi
                        </h2>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Har bir ko'chmas mulk ob'yekti bo'yicha ko'rishlar soni va dinamikasi</p>
                    </div>

                    <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="w-full sm:w-auto justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 flex-shrink-0">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>E'lonlarimga qaytish</span>
                    </a>
                </div>

                <!-- 4 Overview Stat Cards (Responsive Grid: 1 col on small mobile, 2 col on tablet, 4 col on desktop) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
                    <!-- Card 1: Jami Ko'rishlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-xs flex items-center gap-3.5 sm:gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block truncate">Jami Ko'rishlar</span>
                            <h3 class="font-black text-xl sm:text-2xl text-slate-900 mt-0.5">{{ number_format($totalViews, 0, '', ' ') }}</h3>
                        </div>
                    </div>

                    <!-- Card 2: Faol E'lonlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-xs flex items-center gap-3.5 sm:gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block truncate">Faol E'lonlar</span>
                            <h3 class="font-black text-xl sm:text-2xl text-slate-900 mt-0.5">{{ $userProducts->where('status', 'active')->count() }} ta</h3>
                        </div>
                    </div>

                    <!-- Card 3: O'rtacha Ko'rishlar -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-xs flex items-center gap-3.5 sm:gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block truncate">O'rtacha Ko'rish</span>
                            <h3 class="font-black text-xl sm:text-2xl text-slate-900 mt-0.5">{{ $avgViews }} ta</h3>
                        </div>
                    </div>

                    <!-- Card 4: Eng Ko'p Ko'rilgan -->
                    <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-xs flex items-center gap-3.5 sm:gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-fire"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="text-[11px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider block truncate">Eng Ommabop E'lon</span>
                            <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 mt-0.5 truncate" title="{{ $topViewedProduct ? $topViewedProduct->name : "Hozircha yo'q" }}">
                                {{ $topViewedProduct ? $topViewedProduct->name : "Hozircha yo'q" }}
                            </h3>
                            @if($topViewedProduct)
                                <span class="text-xs font-extrabold text-amber-600 flex items-center gap-1 mt-0.5">
                                    <i class="fa-regular fa-eye text-[11px]"></i> {{ $topViewedProduct->views->count() }} ko'rish
                                </span>
                            @else
                                <span class="text-xs text-slate-400">0 ko'rish</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Weekly Views Chart Visualization (Responsive Container) -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm sm:text-base flex items-center gap-2">
                                <i class="fa-solid fa-chart-column text-blue-600"></i>
                                <span>Haftalik Ko'rishlar Dinamikasi</span>
                            </h4>
                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium">Oxirgi 7 kunlik e'lon ko'rishlar soni</p>
                        </div>
                        <span class="text-[11px] sm:text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                            7 kunlik grafik
                        </span>
                    </div>

                    <!-- Chart Bars Container with horizontal scroll safety -->
                    <div class="overflow-x-auto no-scrollbar pt-2">
                        <div class="h-44 sm:h-52 min-w-[280px] flex items-end justify-between gap-2 sm:gap-4 px-2 sm:px-4 pb-2 border-b border-slate-100">
                            @if(isset($weeklyViewsData) && count($weeklyViewsData) > 0)
                                @foreach($weeklyViewsData as $item)
                                    <div class="flex-1 flex flex-col items-center gap-1.5 group cursor-pointer">
                                        <span class="text-[10px] sm:text-[11px] font-black text-blue-600 transition-transform group-hover:-translate-y-0.5">
                                            {{ $item['count'] }}
                                        </span>
                                        <div class="w-full max-w-[40px] bg-gradient-to-t from-blue-600 to-blue-400 group-hover:from-blue-700 group-hover:to-blue-500 rounded-t-lg sm:rounded-t-xl transition-all duration-300 shadow-xs" 
                                             style="height: {{ $item['height'] }}%;"></div>
                                        <span class="text-[10px] sm:text-xs font-bold text-slate-500">{{ $item['day'] }}</span>
                                        <span class="text-[9px] text-slate-400 font-medium hidden sm:block">{{ $item['full_date'] }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="w-full text-center py-12 text-xs text-slate-400 font-medium">
                                    Haftalik ko'rishlar ma'lumoti shakllanmoqda
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Har bir e'lon bo'yicha Ko'rishlar Ro'yxati -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-sm sm:text-base">E'lonlar Bo'yicha Ko'rishlar Statistikasi</h4>
                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium">Barcha e'lonlaringizning ko'rishlar ulushi</p>
                        </div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100 whitespace-nowrap">
                            {{ $productCount }} ta e'lon
                        </span>
                    </div>

                    <div class="space-y-3">
                        @forelse($userProducts as $product)
                            @php
                                $viewsCount = $product->views->count();
                                $percentage = $totalViews > 0 ? min(100, round(($viewsCount / $totalViews) * 100)) : 0;
                            @endphp
                            <div class="border border-slate-200/80 rounded-2xl p-3 sm:p-4 hover:border-blue-300 hover:shadow-2xs transition-all space-y-2.5 bg-white">
                                <div class="flex items-start sm:items-center justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0 flex-1">
                                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 relative">
                                            @if(!empty($product->images) && is_array($product->images) && count($product->images) > 0)
                                                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="/images/apartment1.png" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @endif

                                            @if($product->is_top)
                                                <div class="absolute top-1 left-1">
                                                    <span class="bg-amber-400 text-amber-950 font-black text-[8px] px-1 py-0.2 rounded">TOP</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-1.5 flex-wrap">
                                                <h5 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">
                                                    <a href="{{ route('products.show', $product->id) }}" class="hover:text-blue-600 transition-colors">
                                                        {{ $product->name }}
                                                    </a>
                                                </h5>
                                            </div>
                                            <p class="text-[11px] sm:text-xs text-slate-400 font-medium truncate mt-0.5">
                                                {{ $product->city->name_uz ?? ($product->region->name_uz ?? 'Toshkent') }} &middot; <strong class="text-slate-700 font-extrabold">{{ number_format($product->price, 0, '', ' ') }} so'm</strong>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                                        <div class="text-right">
                                            <span class="block text-[10px] sm:text-xs font-bold text-slate-400">Ko'rishlar</span>
                                            <span class="text-xs sm:text-base font-black text-blue-600 flex items-center gap-1 justify-end">
                                                <i class="fa-regular fa-eye text-[11px] sm:text-xs"></i> {{ $viewsCount }} ta
                                            </span>
                                        </div>

                                        <a href="{{ route('products.show', $product->id) }}" class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 border border-slate-200/80 rounded-xl transition-all shadow-2xs" title="E'lonni ko'rish">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-xs sm:text-sm"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Progress Bar Share -->
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-[10px] text-slate-400 font-bold">
                                        <span>Jami ko'rishlar ulushi</span>
                                        <span>{{ $percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 sm:h-2 overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-600 to-indigo-500 h-full rounded-full transition-all duration-500" style="width: {{ max(4, $percentage) }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-slate-400 text-xs font-medium space-y-2">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl">
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                                <p>Hozircha e'lonlaringiz statistikasi mavjud emas.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        @elseif($section === 'chats')
            <!-- ================= CHATLAR SAHIFASI ================= -->
            <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="font-extrabold text-xl text-slate-900 flex items-center gap-2">
                            <i class="fa-regular fa-comments text-blue-600"></i>
                            <span>Chatlar va Muloqotlar Ro'yxati</span>
                        </h2>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Mijozlar va e'lon egalari bilan kelgan barcha habarlar ro'yxati</p>
                    </div>
                    @if(isset($unreadNotificationCount) && $unreadNotificationCount > 0)
                        <span class="bg-red-500 text-white font-extrabold text-xs px-3 py-1 rounded-full animate-pulse">{{ $unreadNotificationCount }} ta yangi xabar</span>
                    @else
                        <span class="bg-slate-100 text-slate-600 font-bold text-xs px-3 py-1 rounded-full">Yangi xabar yo'q</span>
                    @endif
                </div>

                @if($conversations->count() > 0)
                    <!-- Conversations Container -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs text-slate-400 font-bold px-1">
                            <span>Suhbatlar ({{ $conversations->count() }} ta)</span>
                            <span>Aktivlash uchun tanlang</span>
                        </div>

                        <!-- Thread List Items -->
                        <div class="space-y-3">
                            @foreach($conversations as $index => $conv)
                                <div class="border border-slate-200/90 hover:border-blue-300 rounded-2xl p-4 transition-all bg-white shadow-2xs">
                                    <!-- Conversation Header / Item Card -->
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-extrabold flex items-center justify-center text-sm flex-shrink-0 shadow-xs">
                                                {{ strtoupper(substr($conv['partner']?->name ?? 'F', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h3 class="font-extrabold text-sm text-slate-900">{{ $conv['partner']?->name ?? 'Foydalanuvchi' }}</h3>
                                                    @if($conv['unread_count'] > 0)
                                                        <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $conv['unread_count'] }} yangi</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('products.show', $conv['product_id']) }}" target="_blank" class="text-xs text-blue-600 font-extrabold hover:underline flex items-center gap-1 mt-0.5">
                                                    <i class="fa-solid fa-house text-[11px]"></i>
                                                    <span>{{ $conv['product']?->title ?? 'E\'lon' }}</span>
                                                    <i class="fa-solid fa-external-link text-[10px]"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                                            <span class="text-[11px] text-slate-400 font-semibold">{{ $conv['latest_message']?->created_at?->diffForHumans() }}</span>
                                            <button type="button" onclick="toggleThreadWindow({{ $index }}, {{ $conv['product_id'] }}, {{ $conv['partner_id'] }})" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-extrabold text-xs px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 border border-blue-100">
                                                <span>Suhbatni ochish</span>
                                                <i class="fa-solid fa-chevron-down text-[10px] transition-transform" id="chevron-icon-{{ $index }}"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Collapsible Chat Window for this Thread -->
                                    <div id="thread-window-{{ $index }}" class="hidden pt-4 space-y-4">
                                        <!-- Messages List -->
                                        <div class="bg-slate-50/70 border border-slate-100 rounded-2xl p-4 max-h-[350px] overflow-y-auto space-y-3">
                                            @foreach($conv['messages'] as $msg)
                                                @php $isMe = $msg->sender_id === Auth::id(); @endphp
                                                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                                                    <div class="{{ $isMe ? 'bg-blue-600 text-white rounded-2xl rounded-tr-xs' : 'bg-white border border-slate-200 text-slate-800 rounded-2xl rounded-tl-xs' }} max-w-[85%] p-3.5 text-xs leading-relaxed shadow-2xs">
                                                        {{ $msg->message }}
                                                    </div>
                                                    <span class="text-[10px] text-slate-400 font-medium mt-1 px-1">
                                                        {{ $msg->created_at->format('H:i') }}
                                                        @if($isMe)
                                                            <i class="fa-solid {{ $msg->read_at ? 'fa-check-double text-blue-500' : 'fa-check text-slate-400' }} ml-0.5"></i>
                                                        @endif
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Reply Form -->
                                        <form action="{{ route('messages.reply') }}" method="POST" class="flex gap-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $conv['product_id'] }}">
                                            <input type="hidden" name="receiver_id" value="{{ $conv['partner_id'] }}">
                                            <input type="text" name="message" required placeholder="Javobingizni yozing..." class="flex-1 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-600 shadow-2xs">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl transition-all shadow-xs flex items-center gap-1.5">
                                                <span>Yuborish</span>
                                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 space-y-3">
                        <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mx-auto">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-base">Hozircha xabarlar yo'q</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            E'lonlar bo'yicha kelgan va yuborilgan xabarlar shu yerda aks etadi.
                        </p>
                    </div>
                @endif
            </div>

            <script>
                function toggleThreadWindow(index, productId, partnerId) {
                    const el = document.getElementById('thread-window-' + index);
                    const icon = document.getElementById('chevron-icon-' + index);
                    if (el) {
                        const isHidden = el.classList.contains('hidden');
                        if (isHidden) {
                            el.classList.remove('hidden');
                            if (icon) icon.style.transform = 'rotate(180deg)';
                            markAsRead(productId, partnerId);
                        } else {
                            el.classList.add('hidden');
                            if (icon) icon.style.transform = 'rotate(0deg)';
                        }
                    }
                }

                function markAsRead(productId, partnerId) {
                    fetch('{{ route("messages.read") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId, partner_id: partnerId })
                    }).then(res => res.json()).then(data => {
                        console.log('Marked read:', data);
                    });
                }
            </script>

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

        @elseif($section === 'my_page' || $section === 'settings')
            <!-- ================= MENING SAHIFAM VA PROFIL SOZLAMALARI SAHIFASI ================= -->
            <div class="space-y-5">
                
                <!-- 1. HEADER TITLE -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="font-black text-2xl text-slate-900 flex items-center gap-2.5 tracking-tight">
                            <i class="fa-solid fa-user-gear text-blue-600 text-xl"></i>
                            <span>{{ $section === 'settings' ? 'Profil Sozlamalari' : 'Mening Shaxsiy Sahifam' }}</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                            Shaxsiy ma'lumotlaringizni ko'ring va istalgan vaqtda tahrirlang hamda saqlang
                        </p>
                    </div>

                    <div class="flex items-center gap-2.5 flex-wrap">
                        <a href="{{ route('users.show', Auth::id()) }}" target="_blank" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center gap-2">
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            <span>Jonli sahifani ko'rish</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Haqiqatan ham profildan chiqmoqchimisiz?');" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-extrabold text-xs px-4 py-2.5 rounded-xl transition-all flex items-center gap-2 cursor-pointer" title="Hisobdan chiqish">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span>Chiqish</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- VERIFICATION PROGRESS BANNER -->
                <div class="bg-gradient-to-r from-slate-900 via-blue-950 to-slate-900 border border-blue-500/30 rounded-2xl p-5 sm:p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 relative z-10">
                        <div class="space-y-2 flex-1">
                            <div class="flex items-center gap-2.5">
                                <div class="w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-400/30 flex items-center justify-center text-blue-400 text-lg flex-shrink-0">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-extrabold text-base text-white">Hisob tasdiqlanganlik darajasi</h3>
                                        <span class="text-xs font-black px-2.5 py-0.5 rounded-full {{ $verificationStatus['percentage'] == 100 ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                                            {{ $verificationStatus['percentage'] }}%
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-300 font-medium mt-0.5">
                                        @if($verificationStatus['can_create_ad'])
                                            <span class="text-emerald-400 font-bold"><i class="fa-solid fa-circle-check"></i> E'lon joylash huquqi faol.</span> Barcha shartlar bajarilgan.
                                        @else
                                            <span class="text-amber-400 font-bold"><i class="fa-solid fa-triangle-exclamation"></i> E'lon joylash uchun:</span> Email tasdiqlash (+35%), Pasport (+25%) va JShShIR (+25%) talab etiladi.
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="w-full bg-slate-800 rounded-full h-2 overflow-hidden border border-white/10 mt-2">
                                <div class="h-full rounded-full transition-all duration-700 bg-gradient-to-r {{ $verificationStatus['percentage'] == 100 ? 'from-emerald-500 to-teal-400' : 'from-blue-500 to-amber-400' }}" style="width: {{ $verificationStatus['percentage'] }}%"></div>
                            </div>
                        </div>

                        <!-- Action Badges -->
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($verificationStatus['email_verified'])
                                <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold px-3 py-1.5 rounded-xl">
                                    <i class="fa-solid fa-check"></i> Email tasdiqlangan
                                </span>
                            @elseif(empty(Auth::user()->email))
                                <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}#email" class="inline-flex items-center gap-1.5 bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-300 text-xs font-extrabold px-3.5 py-1.5 rounded-xl transition-all cursor-pointer shadow-xs animate-pulse">
                                    <i class="fa-solid fa-plus-circle"></i> Email kiritish
                                </a>
                            @else
                                <button type="button" onclick="openEmailVerificationModal()" class="inline-flex items-center gap-1.5 bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-300 text-xs font-extrabold px-3.5 py-1.5 rounded-xl transition-all cursor-pointer shadow-xs animate-pulse">
                                    <i class="fa-solid fa-envelope"></i> Emailni tasdiqlash
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 2. PROFILNING ASOSIY MA'LUMOTLAR KARTASI (OVERVIEW CARD) -->
                <div class="bg-gradient-to-br from-slate-900 via-[#0B1A30] to-blue-950 rounded-2xl p-6 text-white shadow-md relative overflow-hidden border border-slate-800">
                    <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <!-- User avatar & names -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-black text-2xl sm:text-3xl ring-4 ring-white/10 shadow-lg uppercase">
                                    {{ mb_substr(Auth::user()->name ?? 'M', 0, 1) }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 {{ $verificationStatus['percentage'] == 100 ? 'bg-emerald-500' : 'bg-amber-500' }} text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ring-2 ring-slate-900" title="{{ $verificationStatus['percentage'] }}% Tasdiqlangan">
                                    <i class="fa-solid {{ $verificationStatus['percentage'] == 100 ? 'fa-check' : 'fa-shield' }}"></i>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                                        {{ Auth::user()->name }}
                                    </h3>
                                    <span class="bg-blue-500/30 text-blue-300 border border-blue-400/30 font-extrabold text-[11px] px-2.5 py-0.5 rounded-full capitalize">
                                        {{ Auth::user()->role?->name ?? Auth::user()->type ?? 'Makler' }}
                                    </span>
                                    <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 font-bold text-[11px] px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Faol
                                    </span>
                                </div>

                                <p class="text-xs text-slate-300 font-medium flex items-center gap-2">
                                    <span>&#64;{{ Auth::user()->username ?? 'foydalanuvchi' }}</span>
                                    <span>&bull;</span>
                                    <span>{{ Auth::user()->email ?: 'Email kiritilmagan' }}</span>
                                </p>

                                <div class="text-[11px] text-slate-400 pt-0.5">
                                    Ro'yxatdan o'tgan sana: <strong>{{ Auth::user()->created_at ? Auth::user()->created_at->format('d.m.Y') : 'Yaqinda' }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Stats mini pills -->
                        <div class="flex items-center gap-3 w-full md:w-auto">
                            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-3 flex-1 md:flex-initial text-center min-w-[100px]">
                                <span class="text-[11px] text-slate-300 font-medium block">E'lonlar</span>
                                <span class="text-lg font-black text-white">{{ $productCount }} ta</span>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-3 flex-1 md:flex-initial text-center min-w-[100px]">
                                <span class="text-[11px] text-slate-300 font-medium block">Ko'rishlar</span>
                                <span class="text-lg font-black text-emerald-400">{{ $totalViews }}</span>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-xl p-3 flex-1 md:flex-initial text-center min-w-[100px]">
                                <span class="text-[11px] text-slate-300 font-medium block">Ishonch</span>
                                <span class="text-lg font-black {{ $verificationStatus['percentage'] == 100 ? 'text-emerald-400' : 'text-amber-400' }}">{{ $verificationStatus['percentage'] }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Public Page Link Share Strip -->
                    <div class="mt-5 pt-4 border-t border-slate-700/60 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 min-w-0 w-full">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 min-w-0 w-full sm:w-auto flex-1">
                            <span class="text-xs font-bold text-slate-300 flex-shrink-0">
                                <i class="fa-solid fa-link text-blue-400 mr-1"></i> Shaxsiy havola:
                            </span>
                            <div class="bg-black/30 border border-white/15 rounded-lg px-3 py-1.5 text-xs text-blue-300 font-mono font-bold break-all w-full sm:flex-1 min-w-0">
                                {{ route('users.show', Auth::user()->username ?? Auth::id()) }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2 flex-shrink-0">
                            <button type="button" 
                                    onclick="copyToClipboard('{{ route('users.show', Auth::user()->username ?? Auth::id()) }}', this)" 
                                    class="bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-xs cursor-pointer">
                                <i class="fa-regular fa-copy"></i>
                                <span>Havolani nusxalash</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 3. SHAXSIY MA'LUMOTLARNI TAHRIRLASH FORMASI (UPDATE PROFILE FORM) -->
                <div class="bg-white border border-slate-200/90 rounded-2xl p-6 shadow-xs space-y-6">
                    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-extrabold text-lg text-slate-900 flex items-center gap-2">
                                <i class="fa-solid fa-pen-to-square text-blue-600"></i>
                                <span>Shaxsiy ma'lumotlarni tahrirlash</span>
                            </h3>
                            <p class="text-xs text-slate-400 font-medium mt-0.5">
                                Ismingiz, username, email, telefon va boshqa ma'lumotlaringizni istalgan paytda o'zgartirishingiz mumkin.
                            </p>
                        </div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1 rounded-lg hidden sm:inline-block">
                            * Majburiy maydonlar
                        </span>
                    </div>

                    <form method="POST" action="{{ route('client.profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- ROW 1: Ism va Familiya -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- First Name -->
                            <div class="space-y-1.5">
                                <label for="first_name" class="block text-xs font-extrabold text-slate-700">
                                    Ism <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-regular fa-user text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="first_name" 
                                           name="first_name" 
                                           value="{{ old('first_name', Auth::user()->first_name) }}" 
                                           required 
                                           placeholder="Masalan: Nodirjon" 
                                           class="w-full bg-slate-50 border @error('first_name') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('first_name')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="space-y-1.5">
                                <label for="last_name" class="block text-xs font-extrabold text-slate-700">
                                    Familiya <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-regular fa-user text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="last_name" 
                                           name="last_name" 
                                           value="{{ old('last_name', Auth::user()->last_name) }}" 
                                           required 
                                           placeholder="Masalan: Xamidov" 
                                           class="w-full bg-slate-50 border @error('last_name') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('last_name')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ROW 2: Username va Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div class="space-y-1.5">
                                <label for="username" class="block text-xs font-extrabold text-slate-700">
                                    Foydalanuvchi nomi (Username) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-at text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="username" 
                                           name="username" 
                                           value="{{ old('username', Auth::user()->username) }}" 
                                           required 
                                           placeholder="Masalan: nodirjon_xamidov" 
                                           class="w-full bg-slate-50 border @error('username') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('username')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <label for="email" class="block text-xs font-extrabold text-slate-700">
                                        Elektron pochta (Email) <span class="text-red-500">*</span>
                                    </label>
                                    @if(Auth::user()->email && Auth::user()->email_verified_at)
                                        <span class="text-[10px] font-black text-emerald-600 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full inline-flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check"></i> Tasdiqlangan
                                        </span>
                                    @elseif(Auth::user()->email)
                                        <button type="button" onclick="openEmailVerificationModal()" class="text-[10px] font-black text-amber-700 bg-amber-50 border border-amber-300 hover:bg-amber-100 px-2 py-0.5 rounded-full inline-flex items-center gap-1 cursor-pointer">
                                            <i class="fa-solid fa-triangle-exclamation"></i> Tasdiqlanmagan (Kod olish)
                                        </button>
                                    @else
                                        <span class="text-[10px] font-black text-amber-600 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full inline-flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i> Kiritilmagan
                                        </span>
                                    @endif
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-regular fa-envelope text-sm"></i>
                                    </div>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', Auth::user()->email) }}" 
                                           placeholder="Masalan: nodirjon@example.uz" 
                                           class="w-full bg-slate-50 border @error('email') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                <p class="text-[11px] text-blue-600 font-semibold mt-1">
                                    <i class="fa-solid fa-circle-info mr-1"></i> E'lon/uy joylashtirish uchun emailingizni kiriting, saqlang va tasdiqlang.
                                </p>
                                @error('email')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ROW 3: Telefon -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Phone -->
                            <div class="space-y-1.5">
                                <label for="phone" class="block text-xs font-extrabold text-slate-700">
                                    Telefon raqam <span class="text-slate-400 font-normal">(+15% daraja)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-phone text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', Auth::user()->phone) }}" 
                                           placeholder="+998 90 123 45 67" 
                                           class="w-full bg-slate-50 border @error('phone') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('phone')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ROW 3: Pasport va JSHSHIR -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Passport -->
                            <div class="space-y-1.5" id="passport-field">
                                <div class="flex items-center justify-between">
                                    <label for="passport" class="block text-xs font-extrabold text-slate-700">
                                        Pasport seriya va raqami <span class="text-blue-600 font-bold">*</span>
                                    </label>
                                    <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">
                                        E'lon berish uchun majburiy (+25%)
                                    </span>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-regular fa-id-card text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="passport" 
                                           name="passport" 
                                           value="{{ old('passport', Auth::user()->passport) }}" 
                                           placeholder="Masalan: AA 1234567" 
                                           class="w-full bg-slate-50 border @error('passport') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('passport')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- JSHSHIR -->
                            <div class="space-y-1.5" id="jshshir-field">
                                <div class="flex items-center justify-between">
                                    <label for="jshshir" class="block text-xs font-extrabold text-slate-700">
                                        14 xonali JShShIR (PINFL) <span class="text-blue-600 font-bold">*</span>
                                    </label>
                                    <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">
                                        E'lon berish uchun majburiy (+25%)
                                    </span>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-fingerprint text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           id="jshshir" 
                                           name="jshshir" 
                                           maxlength="14"
                                           value="{{ old('jshshir', Auth::user()->jshshir) }}" 
                                           placeholder="14 xonali raqam (masalan: 31201950000000)" 
                                           class="w-full bg-slate-50 border @error('jshshir') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                </div>
                                @error('jshshir')
                                    <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ROW 4: Parolni yangilash (Xavfsizlik) -->
                        <div class="border-t border-slate-100 pt-5 space-y-4">
                            <div>
                                <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                                    <i class="fa-solid fa-lock text-amber-500"></i>
                                    <span>Parolni o'zgartirish (Ixtiyoriy)</span>
                                </h4>
                                <p class="text-xs text-slate-400 font-medium">
                                    Agar parolni o'zgartirishni istamasangiz, ushbu maydonlarni bo'sh qoldiring.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Password -->
                                <div class="space-y-1.5">
                                    <label for="password" class="block text-xs font-extrabold text-slate-700">
                                        Yangi parol
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-key text-sm"></i>
                                        </div>
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Kamida 6 ta belgi kiriting..." 
                                               class="w-full bg-slate-50 border @error('password') border-red-500 bg-red-50/30 @else border-slate-200 @enderror rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                    </div>
                                    @error('password')
                                        <p class="text-xs text-red-600 font-bold mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="space-y-1.5">
                                    <label for="password_confirmation" class="block text-xs font-extrabold text-slate-700">
                                        Yangi parolni tasdiqlash
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-check-double text-sm"></i>
                                        </div>
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Yangi parolni qayta kiriting..." 
                                               class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-10 pr-3 text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:border-blue-600 focus:bg-white transition-all shadow-xs">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ACTIONS: Submit Button -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs sm:text-sm px-6 py-3 rounded-xl shadow-sm transition-all flex items-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Ma'lumotlarni saqlash va yangilash</span>
                            </button>

                            <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
                                Bekor qilish
                            </a>
                        </div>
                    </form>
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
                            <p class="text-xs text-slate-600 mt-0.5">Mening sahifam bo'limida shaxsiy ma'lumotlaringizni to'liq yangilashingiz mumkin.</p>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- ================= DEFAULT MAIN DASHBOARD & E'LONLARIM VIEW ================= -->
            
            <!-- VERIFICATION PROGRESS BANNER -->
            <div class="bg-gradient-to-r from-[#0B172A] via-blue-950 to-[#0B172A] border border-blue-500/30 rounded-2xl sm:rounded-3xl p-4 sm:p-6 text-white shadow-xl space-y-4">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                    <div class="space-y-2 flex-1">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-blue-500/20 border border-blue-400/30 flex items-center justify-center text-blue-400 text-xl flex-shrink-0">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="font-black text-base sm:text-lg text-white">Hisobni tasdiqlash holati</h3>
                                    <span class="text-xs font-black px-2.5 py-0.5 rounded-full {{ $verificationStatus['percentage'] == 100 ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                                        {{ $verificationStatus['percentage'] }}% Tasdiqlangan
                                    </span>
                                </div>
                                <p class="text-xs text-slate-300 font-medium mt-0.5">
                                    @if($verificationStatus['can_create_ad'])
                                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-circle-check"></i> E'lon joylash huquqi faol.</span> Barcha tasdiqlar bajarilgan.
                                    @else
                                        <span class="text-amber-400 font-bold"><i class="fa-solid fa-triangle-exclamation"></i> E'lon joylash uchun:</span> Elektron pochtani tasdiqlang hamda pasport va 14 xonali JShShIR ni kiriting.
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-slate-800 rounded-full h-2.5 overflow-hidden border border-white/10 mt-3">
                            <div id="dashboard-progress-bar" class="h-full rounded-full transition-all duration-700 bg-gradient-to-r {{ $verificationStatus['percentage'] == 100 ? 'from-emerald-500 to-teal-400' : 'from-blue-500 to-amber-400' }}" style="width: {{ $verificationStatus['percentage'] }}%"></div>
                        </div>
                    </div>

                    <!-- Action Badges -->
                    <div class="flex items-center gap-2 flex-wrap">
                        @if($verificationStatus['email_verified'])
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold px-3 py-1.5 rounded-xl">
                                <i class="fa-solid fa-check"></i> Email (35%)
                            </span>
                        @else
                            <button type="button" onclick="openEmailVerificationModal()" class="inline-flex items-center gap-1.5 bg-amber-500/20 hover:bg-amber-500/30 border border-amber-500/40 text-amber-300 text-xs font-extrabold px-3.5 py-1.5 rounded-xl transition-all cursor-pointer shadow-xs animate-pulse">
                                <i class="fa-solid fa-envelope"></i> Emailni tasdiqlash (+35%)
                            </button>
                        @endif

                        @if($verificationStatus['passport_filled'])
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold px-3 py-1.5 rounded-xl">
                                <i class="fa-solid fa-check"></i> Pasport (25%)
                            </span>
                        @else
                            <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}#passport-field" class="inline-flex items-center gap-1.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 text-xs font-bold px-3 py-1.5 rounded-xl transition-all">
                                <i class="fa-regular fa-id-card"></i> Pasport (+25%)
                            </a>
                        @endif

                        @if($verificationStatus['jshshir_filled'])
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold px-3 py-1.5 rounded-xl">
                                <i class="fa-solid fa-check"></i> JShShIR (25%)
                            </span>
                        @else
                            <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}#jshshir-field" class="inline-flex items-center gap-1.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 text-xs font-bold px-3 py-1.5 rounded-xl transition-all">
                                <i class="fa-solid fa-fingerprint"></i> JShShIR (+25%)
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 1. USER PROFILE HEADER CARD (AS IN USER REQUEST IMAGE) -->
            <div class="bg-[#0B172A] rounded-2xl sm:rounded-3xl p-4 sm:p-6 text-white shadow-xl border border-slate-800 space-y-5">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center font-black text-2xl ring-4 ring-blue-500/20 shadow-md uppercase">
                                {{ mb_substr(Auth::user()->name ?? 'M', 0, 1) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 {{ $verificationStatus['percentage'] == 100 ? 'bg-emerald-500' : 'bg-amber-500' }} text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ring-2 ring-[#0B172A]" title="{{ $verificationStatus['percentage'] }}% Tasdiqlangan">
                                <i class="fa-solid {{ $verificationStatus['percentage'] == 100 ? 'fa-check' : 'fa-shield' }}"></i>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-xl font-black text-white tracking-tight">
                                    {{ Auth::user()->name }}
                                </h3>
                                <span class="bg-blue-500/20 text-blue-400 border border-blue-500/30 font-extrabold text-xs px-2.5 py-0.5 rounded-full capitalize">
                                    {{ Auth::user()->role?->name ?? Auth::user()->type ?? 'Client' }}
                                </span>
                                <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-bold text-xs px-2.5 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Faol
                                </span>
                            </div>

                            <p class="text-xs text-slate-400 font-medium flex items-center gap-2">
                                <span>&#64;{{ Auth::user()->username ?? 'user' }}</span>
                                <span>&bull;</span>
                                <span>{{ Auth::user()->email ?: 'Email kiritilmagan' }}</span>
                            </p>

                            <div class="text-[11px] text-slate-400">
                                Ro'yxatdan o'tgan sana: <strong class="text-slate-200">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d.m.Y') : '10.08.2026' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3 Stats Pills Grid -->
                <div class="grid grid-cols-3 gap-3 pt-2">
                    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-3.5 text-center space-y-0.5">
                        <span class="text-xs font-bold text-slate-400 block">E'lonlar</span>
                        <span class="text-lg font-black text-white block">{{ $productCount }} ta</span>
                    </div>

                    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-3.5 text-center space-y-0.5">
                        <span class="text-xs font-bold text-slate-400 block">Ko'rishlar</span>
                        <span class="text-lg font-black text-emerald-400 block">{{ $totalViews }}</span>
                    </div>

                    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-3.5 text-center space-y-0.5">
                        <span class="text-xs font-bold text-slate-400 block">Ishonch</span>
                        <span class="text-lg font-black {{ $verificationStatus['percentage'] == 100 ? 'text-emerald-400' : 'text-amber-400' }} block">{{ $verificationStatus['percentage'] }}%</span>
                    </div>
                </div>

                <!-- Personal Link Share Strip -->
                <div class="pt-3 border-t border-slate-800/80 space-y-3">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 min-w-0 w-full">
                        <span class="text-xs font-bold text-slate-400 flex items-center gap-1.5 flex-shrink-0">
                            <i class="fa-solid fa-link text-blue-400"></i> Shaxsiy havola:
                        </span>
                        <div class="bg-slate-950/80 border border-slate-800 rounded-xl px-3.5 py-2 text-xs text-blue-400 font-mono font-bold break-all w-full sm:flex-1 min-w-0">
                            {{ route('users.show', Auth::user()->username ?? Auth::id()) }}
                        </div>
                    </div>

                    <button type="button" 
                            onclick="copyToClipboard('{{ route('users.show', Auth::user()->username ?? Auth::id()) }}', this)" 
                            class="w-full sm:w-auto bg-[#0066FF] hover:bg-blue-600 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                        <i class="fa-regular fa-copy"></i>
                        <span>Havolani nusxalash</span>
                    </button>
                </div>
            </div>

            <!-- 2. QUICK ACTION CARDS (4 HORIZONTAL CARDS) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3.5">
                
                <!-- Quick Action 1 -->
                @if($verificationStatus['can_create_ad'])
                    <a href="{{ route('client.products.create') }}" class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center text-sm shadow-xs group-hover:scale-105 transition-transform flex-shrink-0">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate">Yangi e'lon joylash</h4>
                            <p class="text-[11px] text-slate-400 font-medium truncate">Sotuv yoki ijara e'lonini yarating</p>
                        </div>
                    </a>
                @else
                    <button type="button" onclick="handleBlockedAdCreation()" class="w-full bg-white border border-amber-200 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all flex items-center gap-3.5 group text-left cursor-pointer">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center text-sm shadow-xs group-hover:scale-105 transition-transform flex-shrink-0">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm truncate flex items-center gap-1.5">
                                <span>Yangi e'lon</span>
                                <span class="text-[10px] bg-amber-100 text-amber-800 font-bold px-1.5 py-0.2 rounded">Tasdiqlang</span>
                            </h4>
                            <p class="text-[11px] text-amber-600 font-medium truncate">E'lon berish uchun hisobni tasdiqlang</p>
                        </div>
                    </button>
                @endif

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
                    @if($verificationStatus['can_create_ad'])
                        <a href="{{ route('client.products.create') }}" class="text-xs font-extrabold bg-blue-600 hover:bg-blue-700 text-white px-3.5 py-2 rounded-xl flex items-center gap-1.5 shadow-xs transition-all">
                            <i class="fa-solid fa-plus"></i>
                            <span>Yangi e'lon</span>
                        </a>
                    @else
                        <button type="button" onclick="handleBlockedAdCreation()" class="text-xs font-extrabold bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-300 px-3.5 py-2 rounded-xl flex items-center gap-1.5 shadow-xs transition-all cursor-pointer">
                            <i class="fa-solid fa-lock"></i>
                            <span>Yangi e'lon (Tasdiqlang)</span>
                        </button>
                    @endif
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
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-3.5 sm:p-5 shadow-xs hover:shadow-md transition-all space-y-3.5">
                            
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3.5 sm:gap-4">
                                
                                <!-- Left Thumbnail -->
                                <div class="relative w-full sm:w-44 h-40 sm:h-32 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    @if(!empty($product->images) && is_array($product->images) && count($product->images) > 0)
                                        <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="/images/apartment1.png" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @endif

                                    @if($product->is_top)
                                        <div class="absolute top-2 left-2">
                                            <span class="bg-amber-400 text-amber-950 font-black text-[10px] px-2 py-0.5 rounded shadow-xs uppercase tracking-wider flex items-center gap-1">
                                                <i class="fa-solid fa-crown text-[9px]"></i> TOP
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Middle Info -->
                                <div class="flex-1 min-w-0 space-y-1.5">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if($product->is_top)
                                            <span class="bg-amber-100 text-amber-800 font-extrabold text-[11px] px-2.5 py-0.5 rounded-md border border-amber-200 flex items-center gap-1">
                                                <i class="fa-solid fa-crown text-amber-600 text-[10px]"></i> TOP E'lon
                                            </span>
                                        @endif

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
                                        <a href="{{ route('products.show', $product->id) }}" class="hover:underline line-clamp-1">
                                            {{ $product->name }}
                                        </a>
                                    </h4>

                                    <div class="flex items-center gap-2 text-xs text-slate-500 flex-wrap">
                                        <span class="flex items-center gap-1 truncate max-w-[200px] sm:max-w-none">
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
                                    <div class="flex items-center gap-4 text-xs text-slate-500 pt-0.5 flex-wrap">
                                        <span class="flex items-center gap-1.5 font-bold text-slate-800 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-100">
                                            <i class="fa-regular fa-eye text-blue-600 text-sm"></i> 
                                            <span>Ko'rishlar soni: <strong>{{ $product->views->count() }}</strong></span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Actions: Mobile 3-Button Grid & Desktop Column -->
                                <div class="grid grid-cols-3 sm:flex sm:flex-col items-stretch sm:items-end gap-2 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100 flex-shrink-0">
                                    <button type="button" onclick="openTopModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->is_top ? 'true' : 'false' }})" 
                                            class="{{ $product->is_top ? 'bg-amber-50 border-amber-300 text-amber-700 hover:bg-amber-100' : 'bg-gradient-to-r from-amber-500 to-amber-600 text-white hover:from-amber-600 hover:to-amber-700' }} border font-extrabold text-[11px] sm:text-xs px-2.5 sm:px-3.5 py-2 sm:py-1.5 rounded-xl transition-all flex items-center justify-center gap-1.5 shadow-xs cursor-pointer text-center">
                                        <i class="fa-solid fa-crown text-[11px]"></i>
                                        <span class="truncate">{{ $product->is_top ? 'TOPdan' : 'TOPga' }}</span>
                                    </button>

                                    <a href="{{ route('client.products.edit', $product->id) }}" 
                                       class="border border-blue-400 text-blue-600 hover:bg-blue-50 font-extrabold text-[11px] sm:text-xs px-2.5 sm:px-3.5 py-2 sm:py-1.5 rounded-xl transition-all flex items-center justify-center gap-1.5 shadow-xs text-center">
                                        <i class="fa-regular fa-pen-to-square text-[11px]"></i>
                                        <span class="truncate">Tahrir</span>
                                    </a>

                                    <button type="button" onclick="openDeleteProductModal({{ $product->id }}, '{{ addslashes($product->name) }}')" 
                                            class="border border-red-200 text-red-600 hover:bg-red-50 font-extrabold text-[11px] sm:text-xs px-2.5 sm:px-3.5 py-2 sm:py-1.5 rounded-xl transition-all flex items-center justify-center gap-1.5 shadow-xs cursor-pointer text-center">
                                         <i class="fa-regular fa-trash-can text-[11px]"></i>
                                         <span class="truncate">O'chirish</span>
                                     </button>
                                </div>

                            </div>

                            <!-- Bottom Price Recommendation Bar -->
                            <div class="bg-slate-50/90 border border-slate-200/80 rounded-xl px-3.5 sm:px-4 py-2 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 text-xs">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-slate-600 font-medium">Tavsiya etilgan narx: <strong>{{ number_format($product->price * 0.95, 0, '', ' ') }} &ndash; {{ number_format($product->price * 1.05, 0, '', ' ') }} so'm</strong></span>
                                    <span class="bg-emerald-100 text-emerald-700 font-extrabold text-[11px] px-2.5 py-0.5 rounded-md border border-emerald-200">Narx mos</span>
                                </div>
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 font-extrabold hover:underline flex items-center gap-1 self-end sm:self-auto">
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
    <aside class="w-full lg:w-72 xl:w-80 flex-shrink-0 space-y-4 hidden lg:block">
        
        <!-- CARD 1: USER PROFILE & VERIFICATION CARD -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs text-center space-y-4 relative">
            
            <!-- Avatar photo with verified checkmark -->
            <div class="relative w-20 h-20 mx-auto">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white flex items-center justify-center font-black text-2xl uppercase ring-4 ring-slate-100 shadow-md">
                    {{ mb_substr(Auth::user()->name ?? 'M', 0, 1) }}
                </div>
                <div class="absolute right-0 bottom-0 {{ $verificationStatus['percentage'] == 100 ? 'bg-emerald-600' : 'bg-amber-500' }} text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ring-2 ring-white shadow-xs" title="{{ $verificationStatus['percentage'] }}% Tasdiqlangan">
                    <i class="fa-solid {{ $verificationStatus['percentage'] == 100 ? 'fa-check' : 'fa-shield' }}"></i>
                </div>
            </div>

            <div>
                <h3 class="font-black text-slate-900 text-base flex items-center justify-center gap-1.5">
                    <span>{{ Auth::user()->name ?? 'Foydalanuvchi' }}</span>
                    @if($verificationStatus['percentage'] == 100)
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm" title="Tasdiqlangan"></i>
                    @endif
                </h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">
                    &#64;{{ Auth::user()->username ?? 'foydalanuvchi' }}
                </p>
            </div>

            <!-- Key-Value Info Rows -->
            <div class="space-y-2.5 border-t border-b border-slate-100 py-3 text-xs text-left">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 font-medium">Telefon:</span>
                    <span class="font-bold text-slate-800">{{ Auth::user()->phone ?? 'Kiritilmagan' }}</span>
                </div>
                
                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Tasdiqlash darajasi:</span>
                        <span class="font-black {{ $verificationStatus['percentage'] == 100 ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ $verificationStatus['percentage'] }}%
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-700 bg-gradient-to-r {{ $verificationStatus['percentage'] == 100 ? 'from-emerald-500 to-teal-400' : 'from-blue-500 to-amber-500' }}" style="width: {{ $verificationStatus['percentage'] }}%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-1.5 pt-1 text-[11px]">
                    <div class="flex items-center gap-1 {{ $verificationStatus['email_verified'] ? 'text-emerald-600' : 'text-slate-400' }}">
                        <i class="fa-solid {{ $verificationStatus['email_verified'] ? 'fa-check' : 'fa-xmark' }} text-[10px]"></i> Email (35%)
                    </div>
                    <div class="flex items-center gap-1 {{ $verificationStatus['passport_filled'] ? 'text-emerald-600' : 'text-slate-400' }}">
                        <i class="fa-solid {{ $verificationStatus['passport_filled'] ? 'fa-check' : 'fa-xmark' }} text-[10px]"></i> Pasport (25%)
                    </div>
                    <div class="flex items-center gap-1 {{ $verificationStatus['jshshir_filled'] ? 'text-emerald-600' : 'text-slate-400' }}">
                        <i class="fa-solid {{ $verificationStatus['jshshir_filled'] ? 'fa-check' : 'fa-xmark' }} text-[10px]"></i> JShShIR (25%)
                    </div>
                    <div class="flex items-center gap-1 {{ $verificationStatus['phone_filled'] ? 'text-emerald-600' : 'text-slate-400' }}">
                        <i class="fa-solid {{ $verificationStatus['phone_filled'] ? 'fa-check' : 'fa-xmark' }} text-[10px]"></i> Telefon (15%)
                    </div>
                </div>
            </div>

            @if(!$verificationStatus['can_create_ad'])
                <button type="button" onclick="openEmailVerificationModal()" class="w-full bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 font-extrabold text-xs py-2.5 rounded-xl transition-all block text-center shadow-xs cursor-pointer">
                    <i class="fa-solid fa-shield-halved mr-1"></i> Hisobni tasdiqlash
                </button>
            @endif

            <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 font-extrabold text-xs py-2.5 rounded-xl transition-all block text-center shadow-xs">
                Profilni tahrirlash
            </a>
        </div>

        <!-- CARD 2: MENING SAHIFAM SHARE CARD -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs space-y-3">
            <h4 class="font-extrabold text-slate-900 text-sm">Mening sahifam</h4>
            <p class="text-xs text-slate-500 leading-relaxed font-medium">
                Mijozlaringiz sizning barcha e'lonlaringizni shu havola orqali ko'rishadi.
            </p>

            <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl p-2 pl-3">
                <span class="text-xs font-bold text-blue-600 truncate flex-1 font-mono">
                    {{ route('users.show', Auth::user()->username ?? Auth::id()) }}
                </span>
                <button type="button" 
                        onclick="copyToClipboard('{{ route('users.show', Auth::user()->username ?? Auth::id()) }}', this)" 
                        class="p-1.5 text-slate-500 hover:text-blue-600 bg-white rounded-lg border border-slate-200 shadow-xs cursor-pointer transition-all" 
                        title="Nusxalash">
                    <i class="fa-regular fa-copy"></i>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-2 pt-1">
                <a href="{{ route('users.show', Auth::user()->username ?? Auth::id()) }}" target="_blank" class="border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-2 shadow-xs transition-all text-center">
                    <i class="fa-solid fa-arrow-up-right-from-square text-slate-500"></i>
                    <span>Ochish</span>
                </a>

                <button type="button" 
                        onclick="copyToClipboard('{{ route('users.show', Auth::user()->username ?? Auth::id()) }}', this)" 
                        class="border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-xs py-2 rounded-xl flex items-center justify-center gap-2 shadow-xs transition-all cursor-pointer">
                    <i class="fa-solid fa-share-nodes text-slate-500"></i>
                    <span>Ulashish</span>
                </button>
            </div>
        </div>

    </aside>

</div>

<!-- Global Clipboard Helper Script & Verification Handlers -->
<script>
function copyToClipboard(text, btnElement) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
            showCopySuccess(btnElement);
        }).catch(() => {
            fallbackCopyText(text, btnElement);
        });
    } else {
        fallbackCopyText(text, btnElement);
    }
}

function fallbackCopyText(text, btnElement) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    textArea.style.top = "-999999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        document.execCommand('copy');
        showCopySuccess(btnElement);
    } catch (err) {
        alert("Havola: " + text);
    }
    textArea.remove();
}

function showCopySuccess(btnElement) {
    if (!btnElement) return;
    const originalHtml = btnElement.innerHTML;
    btnElement.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');
    btnElement.innerHTML = '<i class="fa-solid fa-check"></i> <span class="text-xs">Nusxalandi!</span>';
    setTimeout(() => {
        btnElement.innerHTML = originalHtml;
        btnElement.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600');
    }, 2000);
}

function openDeleteProductModal(productId, productName) {
    const modal = document.getElementById('deleteProductModal');
    const form = document.getElementById('deleteProductForm');
    const nameEl = document.getElementById('deleteProductName');
    if (modal && form) {
        form.action = '/client/products/' + productId;
        if (nameEl) nameEl.innerText = productName;
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }
}

function closeDeleteProductModal() {
    const modal = document.getElementById('deleteProductModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

function openTopModal(productId, productName, isTop) {
    const modal = document.getElementById('topConfirmModal');
    const form = document.getElementById('topConfirmForm');
    const nameEl = document.getElementById('topConfirmProductName');
    const titleEl = document.getElementById('topModalTitle');
    const descEl = document.getElementById('topModalDesc');
    const btnText = document.getElementById('topModalBtnText');

    if (modal && form) {
        form.action = '/client/products/' + productId + '/toggle-top';
        if (nameEl) nameEl.innerText = productName;

        if (isTop) {
            if (titleEl) titleEl.innerText = "TOP darajasidan olish";
            if (descEl) descEl.innerText = "Haqiqatan ham ushbu e'lonni TOP e'lonlar safidan olib tashlamoqchimisiz?";
            if (btnText) btnText.innerText = "TOPdan olish";
        } else {
            if (titleEl) titleEl.innerText = "TOPga chiqarish";
            if (descEl) descEl.innerText = "Haqiqatan ham ushbu e'lonni TOPga chiqarmoqchimisiz? E'loningiz barcha qidiruv va asosiy sahifada eng birinchi bo'lib ko'rinadi.";
            if (btnText) btnText.innerText = "Ha, TOPga chiqarish";
        }

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }
}

function closeTopModal() {
    const modal = document.getElementById('topConfirmModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

// EMAIL VERIFICATION MODAL LOGIC
let resendTimer = null;
let resendSeconds = 60;

function openEmailVerificationModal() {
    const modal = document.getElementById('emailVerificationModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        resetVerificationModalState();
    }
}

function closeEmailVerificationModal() {
    const modal = document.getElementById('emailVerificationModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

function handleBlockedAdCreation() {
    @if(empty(Auth::user()->email))
        window.location.href = "{{ route('client.dashboard', ['section' => 'my_page']) }}#email";
        setTimeout(() => {
            const el = document.getElementById('email');
            if (el) { el.scrollIntoView({ behavior: 'smooth' }); el.focus(); }
        }, 300);
    @elseif(!$verificationStatus['email_verified'])
        openEmailVerificationModal();
    @else
        window.location.href = "{{ route('client.dashboard', ['section' => 'my_page']) }}#passport-field";
    @endif
}

function resetVerificationModalState() {
    document.getElementById('verify-code-input').value = '';
    document.getElementById('verify-alert-box').classList.add('hidden');
    document.getElementById('verify-alert-box').innerHTML = '';
}

function sendVerificationEmailCode() {
    const sendBtn = document.getElementById('btn-send-code');
    const statusBox = document.getElementById('verify-alert-box');
    
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Kod yuborilmoqda...';

    fetch('{{ route("email.send-code") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        statusBox.classList.remove('hidden');
        if (data.success) {
            statusBox.className = 'text-xs p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold block mb-3';
            statusBox.innerHTML = '<i class="fa-solid fa-circle-check mr-1 text-emerald-600"></i> ' + data.message;
            startResendCountdown();
            document.getElementById('verify-code-input').focus();
        } else {
            statusBox.className = 'text-xs p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 font-bold block mb-3';
            statusBox.innerHTML = '<i class="fa-solid fa-circle-exclamation mr-1 text-red-600"></i> ' + (data.message || 'Xatolik yuz berdi.');
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane mr-1"></i> Kodni yuborish';
        }
    })
    .catch(err => {
        statusBox.classList.remove('hidden');
        statusBox.className = 'text-xs p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 font-bold block mb-3';
        statusBox.innerHTML = '<i class="fa-solid fa-circle-exclamation mr-1 text-red-600"></i> Server bilan bog\'lanishda xatolik.';
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<i class="fa-solid fa-paper-plane mr-1"></i> Kodni yuborish';
    });
}

function startResendCountdown() {
    const sendBtn = document.getElementById('btn-send-code');
    resendSeconds = 60;
    if (resendTimer) clearInterval(resendTimer);

    resendTimer = setInterval(() => {
        resendSeconds--;
        if (resendSeconds <= 0) {
            clearInterval(resendTimer);
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fa-solid fa-rotate-right mr-1"></i> Kodni qayta yuborish';
        } else {
            sendBtn.disabled = true;
            sendBtn.innerHTML = `<i class="fa-regular fa-clock mr-1"></i> Qayta yuborish (${resendSeconds}s)`;
        }
    }, 1000);
}

function submitEmailVerificationCode() {
    const code = document.getElementById('verify-code-input').value.trim();
    const statusBox = document.getElementById('verify-alert-box');
    const submitBtn = document.getElementById('btn-verify-submit');

    if (!code || code.length !== 6) {
        statusBox.classList.remove('hidden');
        statusBox.className = 'text-xs p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 font-bold block mb-3';
        statusBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Iltimos, 6 xonali tasdiqlash kodini to\'liq kiriting.';
        return;
    }

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Tekshirilmoqda...';

    fetch('{{ route("email.verify-code") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ code: code })
    })
    .then(res => res.json())
    .then(data => {
        statusBox.classList.remove('hidden');
        if (data.success) {
            statusBox.className = 'text-xs p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold block mb-3';
            statusBox.innerHTML = '<i class="fa-solid fa-circle-check mr-1 text-emerald-600"></i> ' + data.message;
            
            setTimeout(() => {
                window.location.reload();
            }, 1200);
        } else {
            statusBox.className = 'text-xs p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 font-bold block mb-3';
            statusBox.innerHTML = '<i class="fa-solid fa-circle-xmark mr-1 text-red-600"></i> ' + (data.message || 'Kod noto\'g\'ri.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Kodni tasdiqlash';
        }
    })
    .catch(err => {
        statusBox.classList.remove('hidden');
        statusBox.className = 'text-xs p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 font-bold block mb-3';
        statusBox.innerHTML = '<i class="fa-solid fa-circle-exclamation mr-1 text-red-600"></i> Tekshirishda server xatoligi yuz berdi.';
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Kodni tasdiqlash';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    @if(session('open_verification_modal'))
        openEmailVerificationModal();
    @endif
});
</script>

<!-- EMAIL VERIFICATION MODAL -->
<div id="emailVerificationModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 28px; max-width: 460px; width: 100%; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3); position: relative; text-align: center;">
        <button type="button" onclick="closeEmailVerificationModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 34px; height: 34px; border-radius: 50%; font-size: 16px; color: #64748b; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">&times;</button>

        <div style="width: 72px; height: 72px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border: 4px solid #dbeafe;">
            <i class="fa-regular fa-envelope" style="font-size: 28px; color: #0066FF;"></i>
        </div>

        <h3 style="font-size: 20px; font-weight: 900; color: #0f172a; margin-bottom: 6px;">Elektron pochtani tasdiqlash</h3>
        
        @if(empty(Auth::user()->email))
            <p style="font-size: 13px; color: #dc2626; font-weight: 700; line-height: 1.5; margin-bottom: 16px;">
                Siz hali profilingizda elektron pochta manzilingizni kiritmagansiz.
            </p>
            <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 16px; padding: 14px; margin-bottom: 20px; text-align: left;">
                <p style="font-size: 12px; color: #991b1b; font-weight: 600; line-height: 1.5;">
                    <i class="fa-solid fa-circle-info" style="margin-right: 6px;"></i> E'lon qo'shish uchun avval profilingizda emailingizni kiriting va "Saqlash" tugmasini bosing.
                </p>
            </div>
            <div>
                <button type="button" onclick="closeEmailVerificationModal(); const el = document.getElementById('email'); if(el) { el.scrollIntoView({behavior: 'smooth'}); el.focus(); }" style="width: 100%; padding: 13px; border-radius: 14px; font-weight: 800; font-size: 13.5px; background: #0066FF; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(0, 102, 255, 0.3);">
                    <i class="fa-solid fa-pen"></i> Emailni kiritishga o'tish
                </button>
            </div>
        @else
            <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 20px;">
                Tasdiqlash kodi <strong>notifications@estora.uz</strong> orqali quyidagi pochtaga yuboriladi:<br>
                <span style="font-weight: 800; color: #0066FF; font-family: monospace;">{{ Auth::user()->email }}</span>
            </p>

            <!-- Dynamic Status Alert Box -->
            <div id="verify-alert-box" class="hidden"></div>

            <!-- Action Step 1: Send Code Button -->
            <div style="margin-bottom: 20px;">
                <button type="button" id="btn-send-code" onclick="sendVerificationEmailCode()" style="width: 100%; padding: 12px; border-radius: 14px; font-weight: 800; font-size: 13px; background: #0066FF; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(0, 102, 255, 0.3); transition: all 0.2s;">
                    <i class="fa-solid fa-paper-plane"></i> Kodni yuborish
                </button>
            </div>

            <!-- Action Step 2: Enter 6-digit Code -->
            <div style="border-top: 1px solid #f1f5f9; padding-top: 20px; text-align: left;">
                <label for="verify-code-input" style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">
                    6 xonali tasdiqlash kodi:
                </label>
                <input type="text" 
                       id="verify-code-input" 
                       maxlength="6" 
                       placeholder="------" 
                       style="width: 100%; padding: 14px; border-radius: 14px; border: 2px solid #e2e8f0; font-size: 22px; font-weight: 900; letter-spacing: 12px; text-align: center; color: #0f172a; font-family: monospace; outline: none; margin-bottom: 16px; background: #f8fafc;">
                
                <button type="button" id="btn-verify-submit" onclick="submitEmailVerificationCode()" style="width: 100%; padding: 13px; border-radius: 14px; font-weight: 800; font-size: 13.5px; background: #10b981; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3); transition: all 0.2s;">
                    <i class="fa-solid fa-check"></i> Kodni tasdiqlash
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Delete Product Confirmation Modal -->
<div id="deleteProductModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 24px; max-width: 420px; width: 100%; padding: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
        <button type="button" onclick="closeDeleteProductModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>

        <div style="width: 68px; height: 68px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border: 4px solid #fee2e2;">
            <i class="fa-regular fa-trash-can" style="font-size: 26px; color: #ef4444;"></i>
        </div>

        <h3 style="font-size: 19px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">E'lonni o'chirish</h3>
        <p id="deleteProductName" style="font-size: 13px; font-weight: 700; color: #3b82f6; margin-bottom: 8px;"></p>
        <p style="font-size: 13.5px; color: #64748b; line-height: 1.5; margin-bottom: 24px;">
            Haqiqatan ham ushbu e'lonni o'chirmoqchimisiz? Ushbu amalni ortga qaytarib bo'lmaydi.
        </p>

        <div style="display: flex; gap: 12px;">
            <button type="button" onclick="closeDeleteProductModal()" style="flex: 1; padding: 12px; border-radius: 12px; font-weight: 700; font-size: 13px; background: #f1f5f9; color: #334155; border: none; cursor: pointer;">
                Bekor qilish
            </button>
            
            <form id="deleteProductForm" method="POST" action="" style="flex: 1; margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" style="width: 100%; padding: 12px; border-radius: 12px; font-weight: 800; font-size: 13px; background: #ef4444; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                    <i class="fa-regular fa-trash-can"></i> O'chirish
                </button>
            </form>
        </div>
    </div>
</div>

<!-- TOP Product Confirmation Modal -->
<div id="topConfirmModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: white; border-radius: 24px; max-width: 420px; width: 100%; padding: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
        <button type="button" onclick="closeTopModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>

        <div style="width: 68px; height: 68px; background: #fef3c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border: 4px solid #fde68a;">
            <i class="fa-solid fa-crown" style="font-size: 26px; color: #d97706;"></i>
        </div>

        <h3 id="topModalTitle" style="font-size: 19px; font-weight: 800; color: #0f172a; margin-bottom: 6px;">TOPga chiqarish</h3>
        <p id="topConfirmProductName" style="font-size: 13px; font-weight: 700; color: #d97706; margin-bottom: 8px;"></p>
        <p id="topModalDesc" style="font-size: 13.5px; color: #64748b; line-height: 1.5; margin-bottom: 24px;">
            Haqiqatan ham ushbu e'lonni TOPga chiqarmoqchimisiz? E'loningiz barcha qidiruv va asosiy sahifada eng birinchi bo'lib ko'rinadi.
        </p>

        <div style="display: flex; gap: 12px;">
            <button type="button" onclick="closeTopModal()" style="flex: 1; padding: 12px; border-radius: 12px; font-weight: 700; font-size: 13px; background: #f1f5f9; color: #334155; border: none; cursor: pointer;">
                Bekor qilish
            </button>
            
            <form id="topConfirmForm" method="POST" action="" style="flex: 1; margin: 0;">
                @csrf
                <button type="submit" style="width: 100%; padding: 12px; border-radius: 12px; font-weight: 800; font-size: 13px; background: #d97706; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);">
                    <i class="fa-solid fa-crown"></i> <span id="topModalBtnText">Ha, TOPga chiqarish</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

