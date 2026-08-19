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

<!-- SERVICES SECTION -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Qo'shimcha uy xizmatlari</h2>
                <p class="section-subtitle">Uy bilan bog'liq har qanday muammoda — bitta qo'ng'iroq, ishonchli yechim.</p>
            </div>
            <a href="{{ route('maniDashboard') }}" class="btn-login" style="font-weight: 700; color: var(--accent-blue);">Barchasini ko'rish &rarr;</a>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon-box"><i class="fas fa-couch"></i></div>
                <span class="service-title">Dizayner</span>
                <p class="service-desc">Interer & Ekster'er</p>
                <i class="fas fa-arrow-right" style="color: var(--accent-blue); margin-top: auto;"></i>
            </div>
            <div class="service-card">
                <div class="service-icon-box"><i class="fas fa-bed"></i></div>
                <span class="service-title">Mebel</span>
                <p class="service-desc">Ta'mirlash & Buyurtma</p>
                <i class="fas fa-arrow-right" style="color: var(--accent-blue); margin-top: auto;"></i>
            </div>
            <div class="service-card">
                <div class="service-icon-box"><i class="fas fa-truck-moving"></i></div>
                <span class="service-title">Ko'chish</span>
                <p class="service-desc">Uydan-uyga ko'chirish</p>
                <i class="fas fa-arrow-right" style="color: var(--accent-blue); margin-top: auto;"></i>
            </div>
            <div class="service-card">
                <div class="service-icon-box"><i class="fas fa-bolt"></i></div>
                <span class="service-title">Elektrik</span>
                <p class="service-desc">O'rnatish & Ta'mirlash</p>
                <i class="fas fa-arrow-right" style="color: var(--accent-blue); margin-top: auto;"></i>
            </div>
            <div class="service-card">
                <div class="service-icon-box"><i class="fas fa-faucet"></i></div>
                <span class="service-title">Santexnik</span>
                <p class="service-desc">O'rnatish & Ta'mirlash</p>
                <i class="fas fa-arrow-right" style="color: var(--accent-blue); margin-top: auto;"></i>
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
