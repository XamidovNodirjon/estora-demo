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
                            @foreach($regionAnalytics ?? [] as $reg)
                                <option value="{{ $reg['id'] }}" {{ $reg['id'] == ($defaultAnalyticsRegionId ?? 1) ? 'selected' : '' }}>
                                    {{ $reg['name'] }}{{ $reg['count'] > 0 ? ' (' . $reg['count'] . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <!-- Bottom Floating Glassmorphic Analytics Widgets (filled by JS from real listings) -->
                <div class="market-map-bottom-widgets">
                    <div class="market-widgets-grid">
                        <!-- Widget 1: Average price per m² + monthly trend -->
                        <div class="market-stat-card trend-widget">
                            <div class="stat-card-header">
                                <span class="stat-card-title">O'rtacha 1 m² narxi</span>
                                <i class="fas fa-info-circle stat-info-icon" title="Tanlangan hududda sotuvdagi kvartira va hovlilarning 1 m² o'rtacha narxi (faol e'lonlar asosida)"></i>
                            </div>
                            <div class="stat-meta-row">
                                <span class="stat-main-price" id="widgetAvgM2Price">—</span>
                                <span class="stat-badge" id="widgetTrendBadge" title="Oxirgi 3 oy, undan oldingi 3 oyga nisbatan" hidden></span>
                            </div>
                            <div class="stat-period" id="widgetActiveAdsInfo">Ma'lumotlar yuklanmoqda…</div>
                            <div class="stat-chart-container" id="widgetTrendChart" hidden>
                                <svg viewBox="0 0 160 42" class="stat-trend-svg" preserveAspectRatio="none" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="trendGradientLive" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#2563eb" stop-opacity="0.35"/>
                                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.0"/>
                                        </linearGradient>
                                    </defs>
                                    <path id="widgetTrendArea" fill="url(#trendGradientLive)" />
                                    <path id="widgetTrendLine" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>

                        <!-- Widget 2: Most expensive districts by average price per m² -->
                        <div class="market-stat-card ranking-widget">
                            <div class="stat-card-header">
                                <span class="stat-card-title">Eng qimmat tumanlar</span>
                                <div class="ranking-header-right">
                                    <span class="stat-badge badge-muted" id="widgetDistrictsCount" hidden></span>
                                    <i class="fas fa-info-circle stat-info-icon" title="Tumanlar kesimida 1 m² o'rtacha narxi"></i>
                                </div>
                            </div>
                            <div class="districts-ranking-list" id="widgetDistrictsList"></div>
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
    const defaultRegionId = @json($defaultAnalyticsRegionId ?? null);
    const listingsUrl = @json(route('maniDashboard'));
    if (!analyticsData || !analyticsData.length) return;

    const mapContainer = document.getElementById('marketAnalyticsLeafletMap');
    const regionSelect = document.getElementById('analyticsRegionSelect');
    const avgM2PriceEl = document.getElementById('widgetAvgM2Price');
    const trendBadgeEl = document.getElementById('widgetTrendBadge');
    const activeAdsInfoEl = document.getElementById('widgetActiveAdsInfo');
    const trendChartEl = document.getElementById('widgetTrendChart');
    const trendLineEl = document.getElementById('widgetTrendLine');
    const trendAreaEl = document.getElementById('widgetTrendArea');
    const districtsListEl = document.getElementById('widgetDistrictsList');
    const districtsCountEl = document.getElementById('widgetDistrictsCount');

    if (!mapContainer || typeof L === 'undefined') return;

    const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, ch => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[ch]));

    const districtUrl = (region, district) =>
        `${listingsUrl}?transaction_type=Sotuv&region_id=${region.id}&city_id=${district.id}`;

    let activeRegion = analyticsData.find(r => r.id == defaultRegionId) || analyticsData[0];
    let currentMarkers = [];

    const marketMap = L.map('marketAnalyticsLeafletMap', {
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

    L.control.zoom({ position: 'topleft' }).addTo(marketMap);

    function renderTrend(region) {
        if (!trendBadgeEl) return;
        if (region.trend === null || region.trend === undefined) {
            trendBadgeEl.hidden = true;
            return;
        }
        const up = region.trend >= 0;
        trendBadgeEl.className = 'stat-badge ' + (up ? 'badge-green' : 'badge-red');
        trendBadgeEl.innerHTML = `<i class="fas fa-arrow-${up ? 'up' : 'down'}"></i> ${Math.abs(region.trend).toFixed(1)}%`;
        trendBadgeEl.hidden = false;
    }

    // Sparkline of monthly average $/m²; hidden until there are at least two months of data
    function renderSparkline(region) {
        if (!trendChartEl) return;
        const series = region.series || [];
        if (series.length < 2) {
            trendChartEl.hidden = true;
            return;
        }
        const values = series.map(p => p.value);
        const min = Math.min(...values);
        const max = Math.max(...values);
        const range = max - min || 1;
        const points = values.map((v, i) => {
            const x = (i / (values.length - 1)) * 160;
            const y = 36 - ((v - min) / range) * 30;
            return `${x.toFixed(1)},${y.toFixed(1)}`;
        });
        trendLineEl.setAttribute('d', 'M' + points.join(' L'));
        trendAreaEl.setAttribute('d', 'M' + points.join(' L') + ' L160,42 L0,42 Z');
        trendChartEl.hidden = false;
    }

    function renderDistrictList(region) {
        if (!districtsListEl) return;
        const districts = region.districts || [];

        if (districtsCountEl) {
            districtsCountEl.textContent = `${districts.length} ta tuman`;
            districtsCountEl.hidden = districts.length === 0;
        }

        if (!districts.length) {
            districtsListEl.innerHTML = `
                <div class="ranking-empty">
                    <i class="far fa-folder-open"></i>
                    <span>Bu hududda hali sotuvdagi uy e'lonlari yo'q</span>
                </div>`;
            return;
        }

        districtsListEl.innerHTML = '';
        districts.slice(0, 3).forEach((district, idx) => {
            const itemEl = document.createElement('button');
            itemEl.type = 'button';
            itemEl.className = 'ranking-item';
            itemEl.title = `${district.name}: ${district.count} ta e'lon`;
            itemEl.innerHTML = `
                <span class="ranking-num">0${idx + 1}</span>
                <span class="ranking-name">${escapeHtml(district.short_name)}</span>
                <span class="ranking-price">${escapeHtml(district.m2_formatted)}</span>
            `;
            itemEl.addEventListener('click', function() {
                marketMap.flyTo([district.lat, district.lng], Math.max(region.zoom + 2, 12), { duration: 0.8 });
                const targetMarker = currentMarkers.find(m => m.districtId === district.id);
                if (targetMarker) targetMarker.openPopup();
            });
            districtsListEl.appendChild(itemEl);
        });
    }

    function renderMarkers(region) {
        currentMarkers.forEach(m => marketMap.removeLayer(m));
        currentMarkers = [];

        (region.districts || []).forEach(district => {
            if (!district.lat || !district.lng) return;

            const icon = L.divIcon({
                className: 'district-price-pin',
                html: `
                    <div class="district-price-tag">
                        <span class="d-dot"></span>
                        <span class="d-name">${escapeHtml(district.short_name)}</span>
                        <span class="d-price">${escapeHtml(district.m2_formatted)}</span>
                    </div>
                `,
                iconSize: [0, 0],
                iconAnchor: [0, 0]
            });

            const popupHtml = `
                <div class="district-popup-box">
                    <div class="popup-district-title">
                        <span><i class="fas fa-building" style="color:#2563eb; margin-right:6px;"></i>${escapeHtml(district.name)}</span>
                    </div>
                    <div class="popup-stat-row">
                        <span>1 m² o'rtacha:</span>
                        <strong>${escapeHtml(district.m2_formatted)}</strong>
                    </div>
                    <div class="popup-stat-row">
                        <span>O'rtacha umumiy narx:</span>
                        <strong>${escapeHtml(district.price_formatted)}</strong>
                    </div>
                    <div class="popup-stat-row">
                        <span>Sotuvdagi e'lonlar:</span>
                        <strong style="color: #2563eb;">${district.count} ta</strong>
                    </div>
                    <a href="${districtUrl(region, district)}" class="popup-btn-link">
                        E'lonlarni ko'rish &rarr;
                    </a>
                </div>
            `;

            const marker = L.marker([district.lat, district.lng], { icon })
                .bindPopup(popupHtml, { offset: [0, -14], closeButton: false })
                .addTo(marketMap);

            marker.districtId = district.id;
            currentMarkers.push(marker);
        });
    }

    function updateAnalyticsView(region, animate) {
        if (!region) return;
        activeRegion = region;

        if (animate) {
            marketMap.flyTo([region.lat, region.lng], region.zoom, { duration: 1.2, easeLinearity: 0.25 });
        }

        if (avgM2PriceEl) {
            avgM2PriceEl.textContent = region.avg_m2_formatted;
        }
        if (activeAdsInfoEl) {
            activeAdsInfoEl.innerHTML = region.count > 0
                ? `Sotuvdagi kvartira va hovlilar: <strong>${region.count} ta</strong>`
                : `Hozircha sotuvdagi uy e'lonlari yo'q`;
        }

        renderTrend(region);
        renderSparkline(region);
        renderDistrictList(region);
        renderMarkers(region);
    }

    updateAnalyticsView(activeRegion, false);

    if (regionSelect) {
        regionSelect.addEventListener('change', function() {
            const region = analyticsData.find(r => r.id == this.value);
            updateAnalyticsView(region, true);
        });
    }

    // The map may be laid out after Leaflet initialises (fonts, responsive grid) — re-measure once.
    window.addEventListener('load', () => marketMap.invalidateSize());
});
</script>
@endsection
