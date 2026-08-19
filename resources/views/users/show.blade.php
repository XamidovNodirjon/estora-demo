<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Muallif Profili - Estora Real Estate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-navy: #061c3f;
            --secondary-navy: #0B2240;
            --accent-blue: #0084ff;
            --accent-blue-hover: #0076e5;
            --accent-orange: #ff9e0d;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #f8f9fa;
            --border-color: #e5e7eb;
            --alert-red: #ef4444;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
        }

        html, body {
            max-width: 100vw !important;
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        img, video, iframe, canvas, svg {
            max-width: 100%;
            height: auto;
        }

        p, span, h1, h2, h3, h4, h5, h6, div {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .font-display {
            font-family: var(--font-display);
        }

        /* PRODUCT ROW CARD STYLES (MATCHING MANIDASHBOARD 1:1) */
        .search-listings-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-row-card {
            display: grid;
            grid-template-columns: 320px 1fr 280px;
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-row-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        .product-carousel-container {
            position: relative;
            height: 100%;
            min-height: 240px;
            background-color: #f1f3f5;
            overflow: hidden;
        }

        .carousel-track-wrapper {
            height: 100%;
            width: 100%;
            position: relative;
        }

        .carousel-slide-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 1;
        }

        .carousel-slide-img.active {
            opacity: 1;
            z-index: 2;
        }

        .badge-top-left {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 3;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .yaxshi-taklif-badge {
            background-color: #e6f7eb;
            color: #2b8a3e;
            border: 1px solid #c3fae8;
        }

        .carousel-control-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.8);
            color: var(--primary-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }

        .carousel-control-btn:hover {
            background-color: #ffffff;
            color: var(--accent-blue);
        }

        .prev-btn { left: 10px; }
        .next-btn { right: 10px; }

        .carousel-index-badge {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .product-details-block {
            padding: 24px;
            display: flex;
            flex-direction: column;
        }

        .id-row {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 12px;
        }

        .product-id-badge {
            background-color: #fff9db;
            color: #f59f00;
            border: 1px solid #ffe066;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .negotiable-badge {
            background-color: #e8f7ff;
            color: #1c7ed6;
            border: 1px solid #a5d8ff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
        }

        .product-title-text {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .product-price-text {
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 800;
            color: var(--accent-orange);
            margin-bottom: 12px;
        }

        .product-location-text {
            font-size: 15px;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 12px;
        }

        .location-landmark-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 16px;
        }

        .location-time i, .landmark-name i {
            color: var(--accent-blue);
            margin-right: 4px;
        }

        .date-published-row {
            margin-top: auto;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .product-actions-specs {
            padding: 24px;
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .top-meta-icons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 16px;
        }

        .action-meta-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-meta-btn:hover {
            color: var(--accent-blue);
            border-color: var(--accent-blue);
            background-color: #f8f9fa;
        }

        .phone-action-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .phone-reveal-btn {
            width: 100%;
            background-color: var(--secondary-navy);
            color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s;
            border: none;
        }

        .phone-reveal-btn:hover {
            background-color: var(--primary-navy);
        }

        .action-row-secondary {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .tg-write-btn {
            flex: 1;
            border: 1px solid var(--border-color);
            color: var(--text-dark);
            padding: 10px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            background-color: #ffffff;
        }

        .tg-write-btn:hover {
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            background-color: #f8f9fa;
        }

        .action-icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: #ffffff;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            font-size: 15px;
        }

        .action-icon-btn:hover {
            color: var(--accent-blue);
            border-color: var(--accent-blue);
            background-color: #f8f9fa;
        }

        .action-icon-btn.is-favorite {
            color: #ef4444;
            border-color: #fca5a5;
            background-color: #fef2f2;
        }

        .specs-grid-box {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            margin-bottom: 12px;
        }

        .spec-tag {
            background-color: #f8f9fa;
            border: 1px solid #f1f3f5;
            padding: 6px 4px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .quality-tags-box {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .quality-tag {
            background-color: #fff9db;
            color: #f59f00;
            border: 1px solid #ffe066;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .finance-badges-box {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: auto;
        }

        .finance-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .ipoteka-badge {
            background-color: #e8f7ff;
            color: #1c7ed6;
            border: 1px solid #a5d8ff;
        }

        .subsidiya-badge {
            background-color: #f3d9fa;
            color: #ae3ec9;
            border: 1px solid #eebefa;
        }

        /* RESPONSIVE CARD ADJUSTMENTS */
        @media (max-width: 1024px) {
            .product-row-card {
                grid-template-columns: 280px 1fr;
            }
            .product-actions-specs {
                grid-column: span 2;
                border-left: none;
                border-top: 1px solid var(--border-color);
                flex-direction: row;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }
            .phone-action-container {
                margin-bottom: 0;
                flex: 1;
            }
        }

        @media (max-width: 640px) {
            .product-row-card {
                grid-template-columns: 1fr;
            }
            .product-carousel-container {
                height: 220px;
            }
            .product-actions-specs {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

    <!-- Top Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('maniDashboard') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity" title="Orqaga qaytish / Bosh sahifa">
                    <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-10 w-auto object-contain">
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="/" class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 font-semibold text-xs sm:text-sm hover:bg-gray-200 transition-all flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-left"></i> Asosiy sahifa
                </a>
                @auth
                    <a href="{{ route('client.dashboard', ['section' => 'my_page']) }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white font-semibold text-xs sm:text-sm hover:bg-blue-700 transition-all flex items-center gap-1.5 shadow-xs">
                        <i class="fa-solid fa-user-gear"></i> Mening kabinetim
                    </a>
                    @if(Auth::id() === $user->id)
                        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Haqiqatan ham profildan chiqmoqchimisiz?');" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer flex items-center justify-center border border-gray-200" title="Profildan chiqish">
                                <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full space-y-8">
        
        <!-- Seller Profile Banner Card -->
        <div class="bg-gradient-to-r from-[#061c3f] via-[#092857] to-[#0B2240] rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden shadow-xl">
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                <i class="fa-solid fa-user-tie text-[220px]"></i>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                <!-- Avatar Circle -->
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-white/10 text-amber-400 border-2 border-white/20 flex items-center justify-center font-bold text-4xl shadow-inner font-display flex-shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <!-- Seller Details -->
                <div class="flex-1 space-y-2">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <span class="px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full inline-block mr-1 {{ $userRole === 'makler' ? 'bg-amber-400' : 'bg-emerald-400' }}"></span>
                            {{ $userRole === 'makler' ? 'Makler (Rieltor)' : 'Jismoniy shaxs (Uy egasi)' }}
                        </span>
                        <span class="text-xs text-gray-300">ID: {{ 2000000 + $user->id }}</span>
                    </div>

                    <h1 class="font-display font-extrabold text-2xl sm:text-4xl text-white">{{ $user->name }}</h1>

                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-4 text-xs sm:text-sm text-gray-300 pt-1">
                        @if($user->phone)
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-phone text-[#0084ff]"></i>
                                {{ $user->phone }}
                            </span>
                        @endif

                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-calendar-days text-[#0084ff]"></i>
                            A'zo bo'lgan: {{ $user->created_at ? $user->created_at->format('d.m.Y') : '2026' }}
                        </span>

                        <span class="flex items-center gap-1.5 font-bold text-amber-300">
                            <i class="fa-solid fa-layer-group"></i>
                            Jami e'lonlar: {{ $totalCount }} ta
                        </span>
                    </div>
                </div>

                <!-- Contact Action Button -->
                <div class="flex-shrink-0 pt-2 sm:pt-0">
                    <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="px-6 py-3.5 bg-[#0084ff] hover:bg-[#0076e5] text-white font-bold text-xs sm:text-sm rounded-2xl shadow-lg transition-all inline-flex items-center gap-2">
                        <i class="fa-solid fa-comments"></i> Chatlar bo'limi
                    </a>
                </div>
            </div>
        </div>

        <!-- Announcements Listing Section -->
        <div class="bg-white rounded-3xl border border-gray-200 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-4">
                <div>
                    <h2 class="font-display font-bold text-xl sm:text-2xl text-[#061c3f]">
                        Muallifning barcha e'lonlari
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-0.5">
                        {{ $user->name }} tomonidan joylashtirilgan barcha faol ko'chmas mulk takliflari ({{ $totalCount }} ta)
                    </p>
                </div>

                <span class="px-3.5 py-1.5 rounded-xl bg-blue-50 text-[#0084ff] font-bold text-xs border border-blue-100 self-start sm:self-center">
                    Jami {{ $totalCount }} ta e'lon
                </span>
            </div>

            @if($products->count() > 0)
                <div class="search-listings-list">
                    @foreach($products as $product)
                        <div class="product-row-card">
                            <!-- Carousel Block (Left) -->
                            <div class="product-carousel-container">
                                @php
                                    $images = $product->images;
                                    if (is_string($images)) {
                                        $images = json_decode($images, true);
                                    }
                                    $images = is_array($images) ? $images : [];
                                @endphp
                                
                                <a href="{{ route('products.show', $product->id) }}" style="display: block; width: 100%; height: 100%; text-decoration: none; color: inherit;">
                                    <div class="carousel-track-wrapper">
                                        @if(count($images) > 0)
                                            @foreach($images as $index => $img)
                                                <img src="{{ Str::startsWith($img, 'http') ? $img : (Str::startsWith($img, '/storage') ? $img : (Str::startsWith($img, 'storage') ? '/' . $img : '/storage/' . $img)) }}" 
                                                     class="carousel-slide-img {{ $loop->first ? 'active' : '' }}" 
                                                     data-index="{{ $loop->index }}" 
                                                     alt="{{ $product->name }}">
                                            @endforeach
                                        @else
                                            <img src="/images/apartment1.png" class="carousel-slide-img active" alt="Placeholder">
                                        @endif
                                    </div>
                                </a>
                                
                                <span class="badge-top-left yaxshi-taklif-badge">Yaxshi Taklif</span>
                                
                                @if(count($images) > 1)
                                    <button class="carousel-control-btn prev-btn" onclick="moveSlide(this, -1)"><i class="fas fa-chevron-left"></i></button>
                                    <button class="carousel-control-btn next-btn" onclick="moveSlide(this, 1)"><i class="fas fa-chevron-right"></i></button>
                                @endif
                                
                                <span class="carousel-index-badge">1/{{ max(count($images), 1) }}</span>
                            </div>
                            
                            <!-- Meta Info Block (Middle) -->
                            <div class="product-details-block">
                                <div class="id-row">
                                    <span class="product-id-badge">ID {{ 10000 + $product->id }}</span>
                                    <span class="negotiable-badge">Kelishiladi</span>
                                </div>
                                
                                <h3 class="product-title-text">
                                    <a href="{{ route('products.show', $product->id) }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='var(--accent-blue)'" onmouseout="this.style.color='inherit'">
                                        {{ strtoupper($product->category->name ?? 'SOTUV') }} | {{ strtoupper($product->subCategory->name ?? 'KVARTIRA') }}
                                    </a>
                                </h3>
                                <div class="product-name-subtitle" style="font-size: 15px; font-weight: 700; color: var(--primary-navy); margin-bottom: 8px;">
                                    <a href="{{ route('products.show', $product->id) }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">{{ $product->name }}</a>
                                </div>
                                
                                <div class="product-price-text">
                                    @if($product->price > 0)
                                        {{ number_format($product->price) }} USD
                                    @else
                                        Kelishiladi
                                    @endif
                                </div>
                                
                                <div class="product-location-text">
                                    {{ $product->region->name ?? 'Toshkent shahar' }}, {{ $product->city->name ?? 'Chilonzor tumani' }}
                                </div>
                                
                                <div class="location-landmark-meta">
                                    <span class="location-time">
                                        <i class="fas fa-walking"></i> {{ $product->city->name ?? 'Chilonzor' }} – 20 daqiqa
                                    </span>
                                    @if($product->landmark)
                                        <span class="landmark-name">
                                            <i class="fas fa-map-marker-alt"></i> Mo‘ljal: {{ $product->landmark }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="date-published-row">
                                    E'lon joylangan sana: {{ $product->created_at ? $product->created_at->format('d.m.Y') : '24.07.2026' }}
                                </div>
                            </div>
                            
                            <!-- Action & Specs Block (Right) -->
                            <div class="product-actions-specs">
                                <div class="phone-action-container">
                                    @if($product->phone)
                                        <button class="phone-reveal-btn" onclick="revealPhone(this, '{{ $product->phone }}')">
                                            <i class="fas fa-phone-alt"></i> Telefon raqam
                                        </button>
                                    @else
                                        <button class="phone-reveal-btn disabled" disabled>
                                            <i class="fas fa-phone-alt"></i> Telefon raqam yo'q
                                        </button>
                                    @endif

                                    <div class="action-row-secondary">
                                        <a href="https://t.me/estora_realestate" target="_blank" class="tg-write-btn">
                                            <i class="fab fa-telegram-plane"></i> Telegram orqali yozish
                                        </a>
                                        @php $isFav = Auth::check() && $product->isFavoritedBy(Auth::user()); @endphp
                                        <button type="button" class="action-icon-btn js-favorite-btn {{ $isFav ? 'is-favorite' : '' }}" data-id="{{ $product->id }}" title="Saralanganlar">
                                            <i class="{{ $isFav ? 'fas fa-heart text-red-500' : 'far fa-heart' }}"></i>
                                        </button>
                                        <button type="button" class="action-icon-btn share-btn" onclick="navigator.clipboard.writeText(window.location.origin + '/products/{{ $product->id }}'); alert('E\'lon havolasi nusxalandi!');" title="Ulashish">
                                            <i class="far fa-share-square"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Specs grid -->
                                <div class="specs-grid-box">
                                    <span class="spec-tag"><i class="fas fa-building"></i> {{ $product->floor ?? '1' }}/{{ $product->building_floor ?? '9' }} etaj</span>
                                    <span class="spec-tag"><i class="fas fa-door-open"></i> {{ $product->rooms ?? '1' }} xona</span>
                                    <span class="spec-tag"><i class="fas fa-ruler-combined"></i> {{ $product->square ?? '0' }}m²</span>
                                </div>
                                
                                <!-- Quality tags -->
                                <div class="quality-tags-box">
                                    <span class="quality-tag"><i class="fas fa-tools"></i> {{ $product->repair ?? "Evro" }}</span>
                                    @if($product->metros && $product->metros->count() > 0)
                                        <span class="quality-tag"><i class="fas fa-subway"></i> {{ $product->metros->first()->name }} Metro</span>
                                    @endif
                                </div>
                                
                                <!-- Finance Badges -->
                                <div class="finance-badges-box">
                                    @if($product->credit)
                                        <span class="finance-badge ipoteka-badge"><i class="fas fa-file-signature"></i> Ipoteka</span>
                                    @endif
                                    @if($product->pay_in_installments)
                                        <span class="finance-badge subsidiya-badge"><i class="fas fa-hand-holding-usd"></i> Subsidiya</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-6">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-6">
                    <i class="fa-regular fa-folder-open text-gray-400 text-5xl mb-4 block"></i>
                    <h3 class="font-semibold text-gray-700 text-base mb-1">Hozircha e'lonlar mavjud emas</h3>
                    <p class="text-xs text-gray-400 max-w-sm mx-auto">Ushbu foydalanuvchi tomonidan hali boshqa e'lonlar joylashtirilmagan.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-[#061c3f] text-white py-6 border-t border-navy-950 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs sm:text-sm text-gray-400">
            &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
        </div>
    </footer>

    <!-- Carousel & Phone & Favorite Scripts -->
    <script>
    function moveSlide(btn, direction) {
        const container = btn.closest('.product-carousel-container');
        const slides = container.querySelectorAll('.carousel-slide-img');
        const badge = container.querySelector('.carousel-index-badge');
        if (slides.length <= 1) return;

        let currentIndex = 0;
        slides.forEach((slide, idx) => {
            if (slide.classList.contains('active')) {
                currentIndex = idx;
            }
        });

        slides[currentIndex].classList.remove('active');
        let nextIndex = currentIndex + direction;
        if (nextIndex >= slides.length) nextIndex = 0;
        if (nextIndex < 0) nextIndex = slides.length - 1;

        slides[nextIndex].classList.add('active');
        if (badge) {
            badge.textContent = `${nextIndex + 1}/${slides.length}`;
        }
    }

    function revealPhone(btn, phoneNum) {
        if (phoneNum) {
            btn.innerHTML = `<i class="fas fa-phone-alt"></i> ${phoneNum}`;
        }
    }

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
                            if (icon) icon.className = 'fas fa-heart text-red-500';
                        } else {
                            if (icon) icon.className = 'far fa-heart';
                        }
                    }
                })
                .catch(err => console.error('Favorite toggle error:', err));
            });
        });
    });
    </script>
</body>
</html>
