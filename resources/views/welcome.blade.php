@extends('layouts.public')

@section('title', "Estora Real Estate - Ko'chmas mulkning yagona raqamli ekotizimi")

@section('content')
<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <!-- Floating Hero Card -->
            <div class="hero-left-card">
                <span class="hero-badge">Estora Real Estate</span>
                <h1 class="hero-title">Ko'chmas mulkning yagona raqamli ekotizimi</h1>
                <div class="hero-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-hero-dark">KABINET</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero-dark">KIRISH</a>
                        <a href="{{ route('register') }}" class="btn-hero-blue">RO'YXATDAN O'TISH</a>
                    @endauth
                </div>
            </div>

            <!-- SEARCH FILTER COMPONENT -->
            @include('partials.search-filter')
        </div>
    </div>
</section>

<!-- TICKER NEWS BANNER -->
<div class="ticker-banner">
    <div class="ticker-content">
        <span>Estora yangi imkoniyatlar taqdim etmoqda!</span>
        <span class="ticker-separator">–</span>
        <span>Yangi turar-joy loyihalari ishga tushirildi.</span>
        <span class="ticker-separator">–</span>
        <span>Xalqaro hamkorlik kengaymoqda</span>
        <span class="ticker-separator">–</span>
        <span>Metro va Universitetlar bo'yicha qulay qidiruv tizimi</span>
        <span class="ticker-separator">–</span>
        <span>Estora yangi imkoniyatlar taqdim etmoqda!</span>
        <span class="ticker-separator">–</span>
        <span>Yangi turar-joy loyihalari ishga tushirildi.</span>
        <span class="ticker-separator">–</span>
        <span>Xalqaro hamkorlik kengaymoqda</span>
    </div>
</div>

<!-- BEST OFFERS (TOP PRODUCTS) SECTION -->
<section class="listings-section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Eng yaxshi takliflar</h2>
                <p class="section-subtitle">Siz uchun eng maqbul va samarali yechimlarni topishda ishonchli hamkoringiz bo'lamiz.</p>
            </div>
            <a href="{{ route('maniDashboard') }}" class="btn-filter-settings" style="text-decoration: none;">
                <span>Barchasini ko'rish</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="listings-grid">
            @forelse($topProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <div style="grid-column: 1 / -1; padding: 40px; text-align: center; background: #f8fafc; border: 1px solid var(--border-color); border-radius: 8px; color: #64748b;">
                    <i class="fas fa-home" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px;"></i>
                    <p style="font-weight: 600;">Hozircha faol e'lonlar mavjud emas.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- MARKET ANALYTICS & DISTRICT PRICING SECTION -->
<section class="market-analytics-section">
    <div class="container">
        <div class="market-analytics-layout">
            <!-- Left Column: Info & Features -->
            <div class="market-analytics-info">
                <h2 class="market-analytics-title">Ko'chmas mulk bozorining haqiqiy qiymatini bilib oling.</h2>
                <p class="market-analytics-subtitle">Real vaqt statistikasi, narx dinamikasi va hududlar kesimidagi tahlillar orqali ko'chmas mulk bozorini ishonch bilan baholang.</p>

                <div class="market-features-list">
                    <!-- Feature 1: Real vaqt ma'lumotlari -->
                    <div class="market-feature-item">
                        <div class="feature-icon-box icon-blue">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="feature-text">
                            <h4 class="feature-title">Real vaqt ma'lumotlari</h4>
                            <p class="feature-desc">Narxlar, e'lonlar soni va bozor tendensiyalari doimiy yangilanib, sizga eng so'nggi ma'lumotlarni taqdim etadi.</p>
                        </div>
                    </div>

                    <!-- Feature 2: Interaktiv xarita -->
                    <div class="market-feature-item">
                        <div class="feature-icon-box icon-green">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4 class="feature-title">Interaktiv xarita</h4>
                            <p class="feature-desc">Hududlar kesimida narxlar, infratuzilma va bozor ko'rsatkichlarini xaritada ko'ring, solishtiring va tahlil qiling.</p>
                        </div>
                    </div>

                    <!-- Feature 3: Chuqur tahlil va statistika -->
                    <div class="market-feature-item">
                        <div class="feature-icon-box icon-orange">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="feature-text">
                            <h4 class="feature-title">Chuqur tahlil va statistika</h4>
                            <p class="feature-desc">Narx dinamikasi, bozor faolligi va tarixiy ma'lumotlarni grafiklar hamda analitik ko'rsatkichlar orqali baholang.</p>
                        </div>
                    </div>

                    <!-- Feature 4: Shaxsiy kuzatuv va ogohlantirishlar -->
                    <div class="market-feature-item">
                        <div class="feature-icon-box icon-purple">
                            <i class="far fa-bell"></i>
                        </div>
                        <div class="feature-text">
                            <h4 class="feature-title">Shaxsiy kuzatuv va ogohlantirishlar</h4>
                            <p class="feature-desc">Qiziqtirgan hududlaringiz yoki mulklar bo'yicha narx va bozor o'zgarishlari haqida avtomatik xabarnomalar oling.</p>
                        </div>
                    </div>
                </div>

                <div class="market-analytics-action">
                    <a href="{{ route('maniDashboard') }}" class="btn-market-action">
                        <span>Bozor tahliliga kirish</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Right Column: Interactive Map & Analytics Widgets -->
            <div class="market-map-showcase">
                <!-- Leaflet Interactive Map Container -->
                <div class="market-map-container">
                    <div id="marketAnalyticsLeafletMap"></div>
                </div>

                <!-- Top Region Selector Floating Header -->
                <div class="market-map-top-bar">
                    <div class="market-region-selector-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                        <select id="analyticsRegionSelect" aria-label="Viloyatni tanlang">
                            @if(isset($regionAnalytics))
                                @foreach($regionAnalytics as $reg)
                                    <option value="{{ $reg['id'] }}" {{ $reg['id'] == 1 ? 'selected' : '' }}>{{ $reg['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <!-- Bottom Floating Glassmorphic Analytics Widgets -->
                <div class="market-map-bottom-widgets">
                    <div class="market-widgets-grid">
                        <!-- Widget 1: Price Trend & Average M2 -->
                        <div class="market-stat-card trend-widget">
                            <div class="stat-card-header">
                                <span class="stat-card-title">O'rtacha bozor narxi</span>
                                <i class="fas fa-info-circle stat-info-icon" title="Tanlangan hududdagi 1 m² ko'chmas mulkning o'rtacha narxi"></i>
                            </div>
                            <div class="stat-meta-row">
                                <span class="stat-main-price" id="widgetAvgM2Price">$1,350/m²</span>
                                <span class="stat-badge badge-green" id="widgetTrendBadge"><i class="fas fa-arrow-up"></i> 2.8%</span>
                            </div>
                            <div class="stat-period" id="widgetActiveAdsInfo">Faol e'lonlar: 12 ta &bull; O'tgan 3 oy</div>
                            <div class="stat-chart-container">
                                <svg viewBox="0 0 160 42" class="stat-trend-svg" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="trendGradientLive" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#2563eb" stop-opacity="0.35"/>
                                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.0"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M0,38 Q20,35 40,28 T80,24 T120,16 T160,8 L160,42 L0,42 Z" fill="url(#trendGradientLive)" />
                                    <path d="M0,38 Q20,35 40,28 T80,24 T120,16 T160,8" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>

                        <!-- Widget 2: Most Expensive Districts Ranking -->
                        <div class="market-stat-card ranking-widget">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Eng qimmat hududlar</span>
                                <div class="ranking-header-right">
                                    <span class="stat-badge badge-green"><i class="fas fa-arrow-up"></i> 14.3%</span>
                                    <i class="fas fa-info-circle stat-info-icon" title="Tumanlar kesimida o'rtacha 1 m² narxi"></i>
                                </div>
                            </div>
                            <div class="districts-ranking-list" id="widgetDistrictsList">
                                <!-- Populated dynamically by JavaScript -->
                                <div class="ranking-item">
                                    <span class="ranking-num">01</span>
                                    <span class="ranking-name">Mirobod</span>
                                    <span class="ranking-price">$1,750/m²</span>
                                </div>
                                <div class="ranking-item">
                                    <span class="ranking-num">02</span>
                                    <span class="ranking-name">Yakkasaroy</span>
                                    <span class="ranking-price">$1,600/m²</span>
                                </div>
                                <div class="ranking-item">
                                    <span class="ranking-num">03</span>
                                    <span class="ranking-name">Mirzo Ulug‘bek</span>
                                    <span class="ranking-price">$1,500/m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px; flex-wrap: wrap;">
                    <h2 class="section-title" style="margin-bottom: 0;">Qo'shimcha uy xizmatlari</h2>
                    <span class="services-coming-soon-badge"><i class="fas fa-clock"></i> Tez orada</span>
                </div>
                <p class="section-subtitle">Uy bilan bog'liq har qanday muammoda — bitta qo'ng'iroq, ishonchli yechim.</p>
            </div>
            <div class="services-soon-indicator">
                <i class="far fa-clock"></i>
                <span>Tez kunda ishga tushadi</span>
            </div>
        </div>

        <div class="services-grid">
            <div class="service-card service-card-soon">
                <span class="service-card-badge-soon">Tez orada</span>
                <div class="service-icon-box"><i class="fas fa-couch"></i></div>
                <span class="service-title">Dizayner</span>
                <p class="service-desc">Interer & Ekster'er</p>
                <i class="fas fa-arrow-right service-arrow-soon"></i>
            </div>
            <div class="service-card service-card-soon">
                <span class="service-card-badge-soon">Tez orada</span>
                <div class="service-icon-box"><i class="fas fa-bed"></i></div>
                <span class="service-title">Mebel</span>
                <p class="service-desc">Ta'mirlash & Buyurtma</p>
                <i class="fas fa-arrow-right service-arrow-soon"></i>
            </div>
            <div class="service-card service-card-soon">
                <span class="service-card-badge-soon">Tez orada</span>
                <div class="service-icon-box"><i class="fas fa-truck-moving"></i></div>
                <span class="service-title">Ko'chish</span>
                <p class="service-desc">Uydan-uyga ko'chirish</p>
                <i class="fas fa-arrow-right service-arrow-soon"></i>
            </div>
            <div class="service-card service-card-soon">
                <span class="service-card-badge-soon">Tez orada</span>
                <div class="service-icon-box"><i class="fas fa-bolt"></i></div>
                <span class="service-title">Elektrik</span>
                <p class="service-desc">O'rnatish & Ta'mirlash</p>
                <i class="fas fa-arrow-right service-arrow-soon"></i>
            </div>
            <div class="service-card service-card-soon">
                <span class="service-card-badge-soon">Tez orada</span>
                <div class="service-icon-box"><i class="fas fa-faucet"></i></div>
                <span class="service-title">Santexnik</span>
                <p class="service-desc">O'rnatish & Ta'mirlash</p>
                <i class="fas fa-arrow-right service-arrow-soon"></i>
            </div>
        </div>
    </div>
</section>

<!-- ADVANTAGES SECTION -->
<section class="advantages-section">
    <div class="container">
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 class="section-title">Nima uchun Estora?</h2>
            <p class="section-subtitle">Ko'chmas mulk bozoridagi ishonchli va zamonaviy platformangiz</p>
        </div>

        <div class="advantages-grid">
            <div class="advantage-card">
                <div class="advantage-icon-box"><i class="fas fa-file-invoice-dollar"></i></div>
                <h3 class="advantage-title">To‘liq va aniq bozor ma’lumotlari</h3>
                <p class="advantage-desc">Xarita, radius va bozor narxlari tahlili yordamida eng mos mulkni tez va aniq toping.</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon-box"><i class="fas fa-search-location"></i></div>
                <h3 class="advantage-title">Aqlli va qulay qidiruv</h3>
                <p class="advantage-desc">Radius, metro va universitetlar bo'yicha qidiruv orqali kerakli mulkni tez toping.</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon-box"><i class="fas fa-shield-alt"></i></div>
                <h3 class="advantage-title">Xavfsiz va ishonchli aloqa</h3>
                <p class="advantage-desc">Uy egasi bilan to‘g‘ridan-to‘g‘ri aloqa qiling, vositachisiz bevosita bog‘laning.</p>
            </div>
            <div class="advantage-card">
                <div class="advantage-icon-box"><i class="fas fa-award"></i></div>
                <h3 class="advantage-title">Zamonaviy va xalqaro daraja</h3>
                <p class="advantage-desc">Bitta platformada barcha ko'chmas mulk xizmatlari mahalliy va xalqaro foydalanuvchilar uchun.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const analyticsData = @json($regionAnalytics ?? []);
    if (!analyticsData || !analyticsData.length) return;

    let marketMap = null;
    let currentMarkers = [];
    const mapContainer = document.getElementById('marketAnalyticsLeafletMap');
    const regionSelect = document.getElementById('analyticsRegionSelect');
    const avgM2PriceEl = document.getElementById('widgetAvgM2Price');
    const activeAdsInfoEl = document.getElementById('widgetActiveAdsInfo');
    const districtsListEl = document.getElementById('widgetDistrictsList');

    if (!mapContainer || typeof L === 'undefined') return;

    // Find default region (Tashkent city id: 1 or first)
    let activeRegion = analyticsData.find(r => r.id == 1) || analyticsData[0];

    // Initialize Leaflet Map
    marketMap = L.map('marketAnalyticsLeafletMap', {
        zoomControl: false,
        attributionControl: false,
        scrollWheelZoom: false, // Don't hijack page scroll
        dragging: !L.Browser.mobile,
        tap: !L.Browser.mobile
    }).setView([activeRegion.lat, activeRegion.lng], activeRegion.zoom);

    // Modern clean CartoDB Voyager tiles (crisp & modern UI)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        maxZoom: 18,
        subdomains: 'abcd',
        opacity: 0.95
    }).addTo(marketMap);

    // Add minimal zoom control at top-left
    L.control.zoom({ position: 'topleft' }).addTo(marketMap);

    // Function to render markers and widgets for a given region
    function updateAnalyticsView(region) {
        if (!region) return;

        // Clear existing markers
        currentMarkers.forEach(m => marketMap.removeLayer(m));
        currentMarkers = [];

        // Fly to region center
        marketMap.flyTo([region.lat, region.lng], region.zoom, {
            duration: 1.2,
            easeLinearity: 0.25
        });

        // Update Widget 1: Average Market Price
        if (avgM2PriceEl) {
            avgM2PriceEl.textContent = region.avg_m2_formatted;
        }
        if (activeAdsInfoEl) {
            activeAdsInfoEl.innerHTML = `Faol e'lonlar: <strong>${region.count} ta</strong> &bull; O'tgan 3 oy`;
        }

        // Update Widget 2: Top Districts List
        if (districtsListEl) {
            districtsListEl.innerHTML = '';
            const topList = region.top_districts || region.cities.slice(0, 3);
            topList.forEach((district, idx) => {
                const itemEl = document.createElement('div');
                itemEl.className = 'ranking-item';
                itemEl.innerHTML = `
                    <span class="ranking-num">0${idx + 1}</span>
                    <span class="ranking-name">${district.short_name}</span>
                    <span class="ranking-price">${district.m2_formatted}</span>
                `;
                itemEl.addEventListener('click', function() {
                    marketMap.flyTo([district.lat, district.lng], Math.max(region.zoom + 2, 13), { duration: 0.8 });
                    const targetMarker = currentMarkers.find(m => m.districtId === district.id);
                    if (targetMarker) {
                        targetMarker.openPopup();
                    }
                });
                districtsListEl.appendChild(itemEl);
            });
        }

        // Add custom price markers for each district
        if (region.cities && region.cities.length) {
            region.cities.forEach(city => {
                const customPriceIcon = L.divIcon({
                    className: 'district-price-pin',
                    html: `
                        <div class="district-price-tag">
                            <span class="d-dot"></span>
                            <span class="d-name">${city.short_name}</span>
                            <span class="d-price">${city.m2_formatted}</span>
                        </div>
                    `,
                    iconSize: [120, 32],
                    iconAnchor: [60, 16]
                });

                const popupHtml = `
                    <div class="district-popup-box">
                        <div class="popup-district-title">
                            <span><i class="fas fa-building" style="color:#2563eb; margin-right:6px;"></i>${city.name}</span>
                        </div>
                        <div class="popup-stat-row">
                            <span>1 m² o'rtacha:</span>
                            <strong>${city.m2_formatted}</strong>
                        </div>
                        <div class="popup-stat-row">
                            <span>O'rtacha umumiy narx:</span>
                            <strong>${city.price_formatted}</strong>
                        </div>
                        <div class="popup-stat-row">
                            <span>Faol e'lonlar:</span>
                            <strong style="color: #2563eb;">${city.count} ta</strong>
                        </div>
                        <a href="{{ route('maniDashboard') }}?city_id=${city.id}" class="popup-btn-link">
                            E'lonlarni ko'rish &rarr;
                        </a>
                    </div>
                `;

                const marker = L.marker([city.lat, city.lng], { icon: customPriceIcon })
                    .bindPopup(popupHtml, {
                        offset: [0, -10],
                        closeButton: false
                    })
                    .addTo(marketMap);

                marker.districtId = city.id;
                currentMarkers.push(marker);
            });
        }
    }

    // Initial render
    updateAnalyticsView(activeRegion);

    // Handle Region Select change
    if (regionSelect) {
        regionSelect.addEventListener('change', function() {
            const selectedId = this.value;
            const region = analyticsData.find(r => r.id == selectedId);
            if (region) {
                updateAnalyticsView(region);
            }
        });
    }
});
</script>
@endsection

