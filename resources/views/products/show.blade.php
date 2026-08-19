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
    height: 280px;
    width: 100%;
    border-radius: 12px;
    border: 1px solid var(--border-color);
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
                        <a href="{{ route('users.show', $product->user_id) }}" class="owner-avatar-info">
                            <div class="owner-avatar"><i class="fas fa-user-circle"></i></div>
                            <div>
                                <h4 class="owner-name">{{ $product->user->name ?? 'Muallif' }}</h4>
                                <span class="owner-type">{{ ($product->user->role?->name ?? $product->user->type) === 'makler' ? 'Rieltor / Makler' : 'Uy egasi' }}</span>
                            </div>
                        </a>
                        <div>
                            <button class="card-fav-btn fav-btn-{{ $product->id }} {{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'active' : '' }}" onclick="toggleFavorite({{ $product->id }}, event)" title="Saralanganlarga qo'shish">
                                <i class="{{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="phone-and-price-row">
                        <div class="detail-phone-wrapper">
                            <span class="phone-label">Telefon raqam</span>
                            <div class="phone-reveal-container">
                                <span class="phone-masked-num" id="showPhoneText">+998 ** *** ** **</span>
                                <button class="btn-reveal-phone" id="revealPhoneBtn" onclick="revealProductPhone('{{ $product->phone }}')">Ko'rish</button>
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

function revealProductPhone(phone) {
    const textEl = document.getElementById('showPhoneText');
    const btnEl = document.getElementById('revealPhoneBtn');
    if (phone) {
        textEl.innerText = phone;
        btnEl.innerText = "Qo'ng'iroq";
        btnEl.onclick = () => window.location.href = 'tel:' + phone;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Leaflet map initialization for product location
    const lat = {{ $product->latitude ?: 41.2995 }};
    const lng = {{ $product->longitude ?: 69.2401 }};

    if (document.getElementById('showMap')) {
        const map = L.map('showMap').setView([lat, lng], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>{{ addslashes($product->name ?? "Estora mulki") }}</b><br>{{ number_format($product->price) }} USD')
            .openPopup();
    }
});
</script>
@endsection
