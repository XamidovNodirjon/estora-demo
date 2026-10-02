@extends('layouts.public')

@section('title', ($product->name ?? 'Kvartira') . ' - Estora Real Estate')
@section('meta_description', Str::limit(strip_tags($product->description ?? 'Estora e\'lon tafsilotlari'), 160))

@section('styles')
<style>
.breadcrumbs-container {
    background-color: #f8fafc;
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    font-size: 13.5px;
    color: var(--text-secondary);
    font-weight: 600;
}
.breadcrumbs-container a {
    color: var(--primary-navy);
}
.breadcrumbs-container a:hover {
    color: var(--accent-blue);
}

.product-detail-section {
    padding: 28px 0 60px 0;
    background-color: #fcfdfe;
}

.product-detail-header-block {
    margin-bottom: 24px;
}

.detail-header-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    flex-wrap: wrap;
    gap: 10px;
}

.header-badges-left {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.badge-detail {
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    border-radius: 6px;
    letter-spacing: 0.5px;
}

.kelishiladi-badge { background-color: #e0f2fe; color: #0369a1; }
.ipoteka-badge { background-color: #fef3c7; color: #b45309; }
.subsidiya-badge { background-color: #dcfce7; color: #15803d; }
.date-badge { background-color: #f1f5f9; color: #475569; }

.detail-id-badge {
    background-color: var(--primary-navy);
    color: #ffffff;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 6px;
}

.detail-title-text {
    font-size: 28px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 10px;
    line-height: 1.2;
}

.detail-header-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.header-tag {
    background-color: #f1f5f9;
    color: var(--text-primary);
    padding: 4px 12px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 6px;
}

/* Two-column layout grid */
.detail-columns-grid {
    display: grid;
    grid-template-columns: 1.35fr 1fr;
    gap: 30px;
    align-items: start;
}

/* Gallery Styles */
.detail-gallery-wrapper {
    display: flex;
    gap: 15px;
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 30px;
    height: 480px;
}

.gallery-thumbnails {
    width: 90px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    overflow-y: auto;
    max-height: 100%;
}

.thumb-item {
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.2s;
    flex-shrink: 0;
    aspect-ratio: 1/1;
}

.thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumb-item.active, .thumb-item:hover {
    border-color: var(--accent-blue);
    transform: scale(0.96);
}

.gallery-main-view {
    flex: 1;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background-color: #f3f4f6;
    height: 100%;
}

.main-image-wrapper {
    width: 100%;
    height: 100%;
}

.main-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-top-left-yaxshi {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: #10b981;
    color: white;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 6px;
    z-index: 10;
}

.gallery-controls-overlay {
    position: absolute;
    bottom: 15px;
    right: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 10;
}

.gallery-index-badge {
    background-color: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    color: white;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
}

.gallery-fullscreen-btn {
    background-color: rgba(255,255,255,0.9);
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    color: var(--primary-navy);
    transition: all 0.2s;
}

/* Address Box & Map Styles */
.detail-address-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 30px;
}

.detail-address-box h3 {
    font-size: 18px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 12px;
}

.address-text {
    font-size: 14px;
    color: var(--text-primary);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}

#showMap {
    height: 340px;
    width: 100%;
    border-radius: 14px;
    border: 1px solid var(--border-color);
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.04);
    z-index: 10;
}

/* Custom Pin Marker */
.custom-map-property-pin {
    background: transparent;
    border: none;
}
.map-pin-pulse-wrapper {
    position: relative;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.map-pin-pulse {
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 132, 255, 0.25);
    animation: mapPinPulse 2s infinite ease-in-out;
}
@keyframes mapPinPulse {
    0% { transform: scale(0.8); opacity: 0.9; }
    50% { transform: scale(1.4); opacity: 0.3; }
    100% { transform: scale(0.8); opacity: 0.9; }
}
.map-pin-icon-box {
    position: relative;
    z-index: 2;
    width: 38px;
    height: 38px;
    border-radius: 50% 50% 50% 0;
    background: linear-gradient(135deg, #0084ff 0%, #061c3f 100%);
    transform: rotate(-45deg);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0, 132, 255, 0.4);
    border: 2px solid #ffffff;
    transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.map-pin-pulse-wrapper:hover .map-pin-icon-box {
    transform: rotate(-45deg) scale(1.12);
}
.map-pin-icon-box i {
    transform: rotate(45deg);
    color: #ffffff;
    font-size: 15px;
}

/* Mini Popup Card on Click */
.leaflet-popup-content-wrapper {
    padding: 0 !important;
    border-radius: 14px !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
    overflow: hidden !important;
}
.leaflet-popup-content {
    margin: 0 !important;
    line-height: normal !important;
    width: 250px !important;
}
.leaflet-popup-close-button {
    top: 8px !important;
    right: 8px !important;
    width: 22px !important;
    height: 22px !important;
    background: rgba(0, 0, 0, 0.5) !important;
    color: #ffffff !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 14px !important;
    text-decoration: none !important;
    z-index: 10 !important;
    transition: background 0.2s;
}
.leaflet-popup-close-button:hover {
    background: rgba(0, 0, 0, 0.8) !important;
    color: #ffffff !important;
}
.detail-map-mini-card {
    background: #ffffff;
    font-family: inherit;
    border-radius: 14px;
    overflow: hidden;
}
.detail-map-card-img-wrap {
    position: relative;
    width: 100%;
    height: 110px;
    overflow: hidden;
    background: #f1f5f9;
}
.detail-map-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.detail-map-card-badge {
    position: absolute;
    bottom: 8px;
    left: 8px;
    background: rgba(6, 28, 63, 0.85);
    backdrop-filter: blur(4px);
    color: #38bdf8;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 6px;
    text-transform: uppercase;
}
.detail-map-card-body {
    padding: 10px 12px 12px 12px;
}
.detail-map-card-price {
    font-size: 15px;
    font-weight: 800;
    color: #0084ff;
    margin-bottom: 3px;
    display: flex;
    align-items: baseline;
    gap: 4px;
}
.detail-map-card-title {
    font-size: 12.5px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.35;
    margin-bottom: 6px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.detail-map-card-specs {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    color: #64748b;
    font-weight: 600;
    border-top: 1px solid #f1f5f9;
    padding-top: 6px;
}
.detail-map-card-specs span {
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Right Column Owner / Pricing Card */
.owner-pricing-card {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.owner-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f3f5;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.owner-avatar-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.owner-avatar {
    font-size: 40px;
    color: var(--accent-blue);
}

.owner-name {
    font-size: 16px;
    font-weight: 800;
    color: var(--primary-navy);
}

.owner-type {
    font-size: 12px;
    color: var(--text-secondary);
}

.phone-and-price-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.detail-phone-wrapper {
    flex: 1;
}

.phone-label, .price-label {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: 700;
    color: var(--text-secondary);
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 6px;
}

.phone-reveal-container {
    display: flex;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    overflow: hidden;
    height: 44px;
    align-items: center;
    padding-left: 12px;
    background: #f8fafc;
}

.phone-masked-num {
    font-size: 14px;
    font-weight: 700;
    color: var(--primary-navy);
    flex: 1;
}

.btn-reveal-phone {
    background-color: var(--primary-navy);
    color: white;
    border: none;
    padding: 0 15px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    height: 100%;
}

.btn-reveal-phone:hover {
    background-color: var(--navy-dark);
}

.detail-price-box {
    flex: 1;
}

.price-value {
    font-size: 24px;
    font-weight: 800;
    color: var(--accent-blue);
    display: block;
}

.btn-telegram-direct {
    background: linear-gradient(135deg, #0088cc 0%, #006699 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    width: 100%;
}

/* Parameters Table Box */
.detail-params-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.detail-params-box h3, .detail-amenities-box h3, .detail-desc-box h3 {
    font-size: 18px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 15px;
    border-bottom: 1px solid #f1f3f5;
    padding-bottom: 10px;
}

.params-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 20px;
}

.param-item {
    display: flex;
    justify-content: space-between;
    font-size: 13.5px;
    padding: 6px 0;
    border-bottom: 1px dashed #f1f3f5;
}

.param-label {
    color: var(--text-secondary);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
}

.param-label i {
    width: 16px;
    color: var(--accent-blue);
}

.param-value {
    color: var(--primary-navy);
    font-weight: 700;
}

/* Amenities & Nearby list */
.detail-amenities-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.amenities-group {
    margin-bottom: 15px;
}
.amenities-group:last-child {
    margin-bottom: 0;
}

.group-title {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.group-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.group-tag-item {
    background-color: #f8fafc;
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    font-size: 12.5px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 6px;
}

/* Description Box */
.detail-desc-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.desc-content {
    font-size: 14.5px;
    line-height: 1.7;
    color: var(--text-primary);
}

/* Recommendations styling */
.recommendations-title {
    font-size: 22px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 20px;
}

.recommendations-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 25px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
    overflow-x: auto;
}

.rec-tab-btn {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-secondary);
    padding: 8px 18px;
    border-radius: 8px;
    background: transparent;
    cursor: pointer;
}

.rec-tab-btn.active {
    background-color: #e0f2fe;
    color: var(--accent-blue);
}

.rec-tab-panel {
    display: none;
}
.rec-tab-panel.active {
    display: block;
}

.rec-listings-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

@media (max-width: 992px) {
    .detail-columns-grid { grid-template-columns: 1fr; }
    .rec-listings-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .rec-listings-grid { grid-template-columns: 1fr; }
    .phone-and-price-row { flex-direction: column; }
}
</style>
@endsection

@section('content')
<!-- BREADCRUMBS -->
<div class="breadcrumbs-container">
    <div class="container">
        <a href="{{ url('/') }}">Bosh sahifa</a> / 
        <a href="{{ route('maniDashboard', ['transaction_type' => $product->category->name ?? 'Sotuv']) }}">{{ $product->category->name ?? 'Sotuv' }}</a> / 
        <span>{{ $product->subCategory->name ?? 'Kvartira' }}</span>
    </div>
</div>

<!-- PRODUCT DETAIL CONTENT -->
<div class="product-detail-section">
    <div class="container">
        @if(!empty($isOwner))
            <div style="background: linear-gradient(135deg, #091a3e 0%, #001338 100%); border-radius: 16px; padding: 18px 24px; color: #fff; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <i class="fas fa-chart-bar" style="font-size: 24px; color: var(--accent-blue);"></i>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #93c5fd;">E'lon statistikasi (Faqat sizga ko'rinadi)</div>
                        <h3 style="font-size: 20px; font-weight: 800;">{{ number_format($viewsCount ?? 0) }} ta ko'rishlar soni</h3>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main title & badges -->
        <div class="product-detail-header-block">
            <div class="detail-header-top-row">
                <div class="header-badges-left">
                    @if($product->exchange)
                        <span class="badge-detail kelishiladi-badge">Kelishiladi / Almashish</span>
                    @endif
                    @if($product->credit)
                        <span class="badge-detail ipoteka-badge">Ipoteka</span>
                    @endif
                    @if($product->pay_in_installments)
                        <span class="badge-detail subsidiya-badge">Subsidiya</span>
                    @endif
                    <span class="badge-detail date-badge">E'lon joylangan: {{ $product->created_at ? $product->created_at->format('d.m.Y') : date('d.m.Y') }}</span>
                </div>
                <span class="detail-id-badge">ID {{ 10000 + $product->id }}</span>
            </div>
            
            <h1 class="detail-title-text">{{ $product->name ?? ($product->subCategory->name . ' - ' . $product->square . ' m²') }}</h1>
            
            <div class="detail-header-tags">
                <span class="header-tag">{{ $product->category->name ?? 'Sotuv' }}</span>
                <span class="header-tag">{{ $product->subCategory->name ?? 'Kvartira' }}</span>
                @if($product->region)
                    <span class="header-tag">{{ $product->region->name }}</span>
                @endif
            </div>
        </div>

        <div class="detail-columns-grid">
            <!-- LEFT COLUMN (Gallery and Map) -->
            <div class="detail-left-column">
                <!-- Gallery -->
                <div class="detail-gallery-wrapper">
                    @php
                        $images = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
                        $images = is_array($images) ? $images : [];
                    @endphp
                    
                    <div class="gallery-thumbnails">
                        @if(count($images) > 0)
                            @foreach($images as $idx => $img)
                                @php
                                    $imgUrl = Str::startsWith($img, 'http') || Str::startsWith($img, '/') ? $img : '/storage/' . $img;
                                @endphp
                                <div class="thumb-item {{ $loop->first ? 'active' : '' }}" onclick="switchMainImage(this, '{{ $imgUrl }}', {{ $loop->index + 1 }})">
                                    <img src="{{ $imgUrl }}" alt="Thumbnail">
                                </div>
                            @endforeach
                        @else
                            <div class="thumb-item active">
                                <img src="/images/hero.png" alt="Thumbnail">
                            </div>
                        @endif
                    </div>
                    
                    <div class="gallery-main-view">
                        <div class="main-image-wrapper">
                            @php
                                $firstMain = count($images) > 0 ? (Str::startsWith($images[0], 'http') || Str::startsWith($images[0], '/') ? $images[0] : '/storage/' . $images[0]) : '/images/hero.png';
                            @endphp
                            <img id="mainGalleryImage" src="{{ $firstMain }}" alt="{{ $product->name }}">
                        </div>
                        @if($product->is_top)
                            <span class="badge-top-left-yaxshi">TOP E'lon</span>
                        @endif
                        
                        <div class="gallery-controls-overlay">
                            <span class="gallery-index-badge" id="galleryIndexText">1/{{ max(count($images), 1) }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Address Section & Map -->
                <div class="detail-address-box">
                    <h3>Manzil</h3>
                    <p class="address-text">
                        <i class="fas fa-map-marker-alt" style="color: var(--accent-orange);"></i>
                        {{ $product->region->name ?? 'Toshkent shahri' }}, {{ $product->city->name ?? 'Chilonzor tumani' }}
                        @if($product->landmark)
                            , Mo'ljal: {{ $product->landmark }}
                        @endif
                    </p>
                    
                    <div id="showMap"></div>
                </div>
            </div>

            <!-- RIGHT COLUMN (Pricing, Details, Params, Amenities) -->
            <div class="detail-right-column">
                <div class="owner-pricing-card">
                    <div class="owner-header-row">
                        <a href="{{ $product->user_id ? route('users.show', $product->user_id) : '#' }}" class="owner-avatar-info">
                            <div class="owner-avatar"><i class="fas fa-user-circle"></i></div>
                            <div>
                                <h4 class="owner-name">{{ $product->user?->name ?? 'Muallif' }}</h4>
                                <span class="owner-type">{{ ($product->user?->role?->name ?? $product->user?->type) === 'makler' ? 'Rieltor / Makler' : 'Uy egasi' }}</span>
                            </div>
                        </a>
                        <div>
                            <button class="card-fav-btn fav-btn-{{ $product->id }} {{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'active' : '' }}" onclick="toggleFavorite({{ $product->id }}, event)" title="Saralanganlarga qo'shish">
                                <i class="{{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    @php
                        $isMakler = $product->isMaklerListing();
                        $canViewPhone = $product->canViewPhone(auth()->user());
                    @endphp
                    <div class="phone-and-price-row">
                        <div class="detail-phone-wrapper">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                                <span class="phone-label">Telefon raqam</span>
                                <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 6px; {{ $isMakler ? 'background: #fef3c7; color: #b45309;' : 'background: #e0f2fe; color: #0369a1;' }}">
                                    <i class="{{ $isMakler ? 'fas fa-briefcase' : 'fas fa-user-shield' }}"></i>
                                    {{ $isMakler ? 'Makler' : 'Uy egasi' }}
                                </span>
                            </div>
                            <div class="phone-reveal-container">
                                <span class="phone-masked-num" id="showPhoneText">{{ $canViewPhone ? $product->masked_phone : '+998 ** *** ** **' }}</span>
                                <button class="btn-reveal-phone" id="revealPhoneBtn" onclick="handleRevealPhoneClick({{ $product->id }}, {{ $canViewPhone ? 'true' : 'false' }})">Ko'rish</button>
                            </div>
                            <div id="phoneViewsCounter" style="font-size: 11px; color: #94a3b8; margin-top: 4px; display: flex; align-items: center; gap: 4px;">
                                <i class="fas fa-eye" style="font-size: 10px;"></i>
                                <span>Ko'rishlar: <strong id="phoneViewsCountVal">{{ $product->phone_views_count ?? 0 }}</strong> marta</span>
                            </div>
                        </div>
                        <div class="detail-price-box">
                            <span class="price-label">Narx</span>
                            <span class="price-value">{{ number_format($product->price) }} USD</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name ?? 'Estora e\'lon') }}" target="_blank" rel="noopener" class="btn-telegram-direct">
                            <i class="fab fa-telegram-plane"></i>
                            <span>Telegram orqali ulashish</span>
                        </a>
                    </div>
                </div>

                <!-- Parameters Box -->
                <div class="detail-params-box">
                    <h3>Parametrlar</h3>
                    <div class="params-grid">
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-door-open"></i> Xonalar soni:</span>
                            <span class="param-value">{{ $product->rooms ?? '—' }}</span>
                        </div>
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-ruler-combined"></i> Umumiy maydon:</span>
                            <span class="param-value">{{ $product->square ? $product->square . ' m²' : '—' }}</span>
                        </div>
                        @if($product->floor)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-building"></i> Yashash qavati:</span>
                            <span class="param-value">{{ $product->floor }}</span>
                        </div>
                        @endif
                        @if($product->building_floor)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-layer-group"></i> Uydagi qavatlar:</span>
                            <span class="param-value">{{ $product->building_floor }}</span>
                        </div>
                        @endif
                        @if($product->repair)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-paint-roller"></i> Ta'mir holati:</span>
                            <span class="param-value">{{ $product->repair }}</span>
                        </div>
                        @endif
                        @if($product->sotix)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-tree"></i> Sotix:</span>
                            <span class="param-value">{{ $product->sotix }}</span>
                        </div>
                        @endif
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-exchange-alt"></i> Almashish:</span>
                            <span class="param-value">{{ $product->exchange ? 'Bor' : "Yo'q" }}</span>
                        </div>
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-credit-card"></i> Muddatli to'lov:</span>
                            <span class="param-value">{{ $product->pay_in_installments ? 'Mavjud' : "Yo'q" }}</span>
                        </div>
                    </div>
                </div>

                <!-- Product Items (Amenities / Metros / Universities) -->
                <div class="detail-amenities-box">
                    <h3>Infratuzilma va qulayliklar</h3>
                    
                    @if($product->metros && count($product->metros) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-subway" style="color: var(--accent-blue);"></i> Metro bekatlari:</span>
                            <div class="group-tags">
                                @foreach($product->metros as $metro)
                                    <span class="group-tag-item">{{ $metro->name }} Metro</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($product->universities && count($product->universities) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-graduation-cap" style="color: var(--accent-orange);"></i> Yaqin universitetlar:</span>
                            <div class="group-tags">
                                @foreach($product->universities as $uni)
                                    <span class="group-tag-item">{{ $uni->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($product->items && count($product->items) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-concierge-bell" style="color: var(--success);"></i> Qo'shimcha qulayliklar:</span>
                            <div class="group-tags">
                                @foreach($product->items as $item)
                                    <span class="group-tag-item">{{ $item->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Description (Tavsif) Box -->
                <div class="detail-desc-box">
                    <h3>Tavsif</h3>
                    <div class="desc-content">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function switchMainImage(thumbEl, src, idx) {
    document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
    thumbEl.classList.add('active');
    document.getElementById('mainGalleryImage').src = src;
    const total = document.querySelectorAll('.thumb-item').length;
    document.getElementById('galleryIndexText').innerText = idx + '/' + total;
}

let isPhoneRevealed = false;
let revealedPhoneNumber = null;

function handleRevealPhoneClick(productId, canViewPhone) {
    // If already revealed and clicked again, trigger immediate phone call
    if (isPhoneRevealed && revealedPhoneNumber) {
        window.location.href = 'tel:' + revealedPhoneNumber;
        return;
    }

    // If gated (owner listing + guest), directly open the auth required modal
    if (!canViewPhone) {
        openOwnerAuthModal();
        return;
    }

    const btnEl = document.getElementById('revealPhoneBtn');
    const textEl = document.getElementById('showPhoneText');
    const origText = btnEl.innerText;
    btnEl.innerText = "...";
    btnEl.disabled = true;

    fetch(`/products/${productId}/reveal-phone`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(async res => {
        const data = await res.json();
        if (res.status === 401 || data.require_auth) {
            btnEl.innerText = origText;
            btnEl.disabled = false;
            openOwnerAuthModal();
            return;
        }

        if (data.success && data.phone) {
            isPhoneRevealed = true;
            revealedPhoneNumber = data.phone.replace(/[^\d+]/g, '');
            textEl.innerText = data.phone;
            btnEl.disabled = false;
            btnEl.innerHTML = '<i class="fas fa-phone-alt"></i> Qo\'ng\'iroq';
            btnEl.style.background = '#10b981';
            btnEl.title = "Qo'ng'iroq qilish uchun bosing";

            if (data.phone_views_count !== undefined) {
                const countVal = document.getElementById('phoneViewsCountVal');
                if (countVal) countVal.innerText = data.phone_views_count;
            }
        } else {
            alert(data.message || "Xatolik yuz berdi");
            btnEl.innerText = origText;
            btnEl.disabled = false;
        }
    })
    .catch(err => {
        console.error('Phone reveal error:', err);
        btnEl.innerText = origText;
        btnEl.disabled = false;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // Leaflet map initialization for product location
    const lat = {{ $product->latitude ?: 41.2995 }};
    const lng = {{ $product->longitude ?: 69.2401 }};

    if (document.getElementById('showMap')) {
        const map = L.map('showMap', {
            zoomControl: true,
            scrollWheelZoom: false
        }).setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Custom stylish pulsing pin marker
        const pinIcon = L.divIcon({
            className: 'custom-map-property-pin',
            html: `
                <div class="map-pin-pulse-wrapper" title="Mulka xaritada">
                    <div class="map-pin-pulse"></div>
                    <div class="map-pin-icon-box">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
            `,
            iconSize: [44, 44],
            iconAnchor: [22, 38],
            popupAnchor: [0, -36]
        });

        const marker = L.marker([lat, lng], { icon: pinIcon }).addTo(map);

        @php
            $popupImg = $firstMain ?? '/images/hero.png';
            $propertyName = addslashes($product->name ?? ($product->subCategory->name . ' - ' . $product->square . ' m²'));
            $propertyPrice = number_format($product->price) . ' USD';
            $propertyCategory = addslashes($product->category->name ?? 'Sotuv');
            $propertyRooms = $product->rooms ? $product->rooms . ' xona' : null;
            $propertySquare = $product->square ? $product->square . ' m²' : null;
            $propertyFloor = $product->floor ? $product->floor . '-qavat' : null;
        @endphp

        const miniPopupHtml = `
            <div class="detail-map-mini-card">
                <div class="detail-map-card-img-wrap">
                    <img src="{{ $popupImg }}" class="detail-map-card-img" alt="Property image" onerror="this.src='/images/hero.png'">
                    <span class="detail-map-card-badge">{{ $propertyCategory }}</span>
                </div>
                <div class="detail-map-card-body">
                    <div class="detail-map-card-price">{{ $propertyPrice }}</div>
                    <div class="detail-map-card-title">{{ $propertyName }}</div>
                    <div class="detail-map-card-specs">
                        @if($propertyRooms)
                            <span><i class="fas fa-door-open" style="color: #0084ff;"></i> {{ $propertyRooms }}</span>
                        @endif
                        @if($propertySquare)
                            <span><i class="fas fa-ruler-combined" style="color: #10b981;"></i> {{ $propertySquare }}</span>
                        @endif
                        @if($propertyFloor)
                            <span><i class="fas fa-building" style="color: #f59e0b;"></i> {{ $propertyFloor }}</span>
                        @endif
                    </div>
                </div>
            </div>
        `;

        // Bind rich popup on click (default openPopup olib tashlandi - faqat bosilganda ochiladi)
        marker.bindPopup(miniPopupHtml, {
            maxWidth: 260,
            minWidth: 240,
            className: 'custom-estora-leaflet-popup'
        });
    }
});
</script>
@endsection
