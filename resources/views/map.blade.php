@extends('layouts.public')

@section('title', "O'zbekiston ko'chmas mulk xaritasi - Estora Real Estate")

@section('styles')
<style>
.map-page-wrapper {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 150px);
    min-height: 600px;
    background: #f8fafc;
    position: relative;
}

.map-page-header {
    background: #ffffff;
    border-bottom: 1px solid var(--border-color);
    padding: 14px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    z-index: 10;
}

.map-page-title-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
}

.map-page-title-wrap h1 {
    font-size: 18px;
    font-weight: 800;
    color: var(--primary-navy);
    margin: 0;
}

.map-page-subtitle {
    font-size: 13px;
    color: #64748b;
    font-weight: 600;
}

.map-filters-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.map-filter-select {
    height: 38px;
    padding: 0 12px;
    border: 1.5px solid var(--border-color);
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-navy);
    background: #ffffff;
    outline: none;
    cursor: pointer;
    transition: border-color 0.2s;
}

.map-filter-select:focus {
    border-color: var(--accent-blue);
}

.map-body-container {
    flex: 1;
    position: relative;
    width: 100%;
    height: 100%;
}

#fullscreenEstoraMap {
    width: 100%;
    height: 100%;
    z-index: 1;
}

/* Custom Price Badge Marker */
.custom-map-price-badge {
    background: var(--primary-navy, #091a3e);
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 8px;
    font-weight: 800;
    font-size: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    border: 2px solid #ffffff;
    white-space: nowrap;
    cursor: pointer;
    transition: transform 0.2s, background-color 0.2s;
}

.custom-map-price-badge:hover {
    transform: scale(1.1);
    background: #0084ff;
}

/* Custom Popup Design */
.leaflet-popup-content-wrapper {
    border-radius: 12px;
    padding: 4px;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2);
}

.map-popup-card {
    width: 240px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.map-popup-img {
    width: 100%;
    height: 130px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 8px;
}

.map-popup-price {
    font-size: 15px;
    font-weight: 900;
    color: #0084ff;
    margin-bottom: 2px;
}

.map-popup-title {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.35;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.map-popup-meta {
    font-size: 11.5px;
    color: #64748b;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.map-popup-btn {
    display: block;
    text-align: center;
    background: var(--primary-navy, #091a3e);
    color: #ffffff !important;
    padding: 7px 0;
    border-radius: 6px;
    font-size: 12.5px;
    font-weight: 800;
    text-decoration: none;
    transition: background-color 0.2s;
}

.map-popup-btn:hover {
    background: #0084ff;
}

/* Floating count badge */
.map-floating-badge {
    position: absolute;
    top: 18px;
    left: 60px;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(0,0,0,0.08);
    padding: 8px 16px;
    border-radius: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>
@endsection

@section('content')
<div class="map-page-wrapper">
    <!-- Top Filter & Title Bar -->
    <div class="map-page-header">
        <div class="map-page-title-wrap">
            <i class="fas fa-map-marked-alt" style="color: var(--accent-blue); font-size: 22px;"></i>
            <div>
                <h1>Ko'chmas mulk xaritasi</h1>
                <span class="map-page-subtitle">O'zbekiston va Toshkent shahri bo'yicha e'lonlar</span>
            </div>
        </div>

        <!-- Quick Filters -->
        <div class="map-filters-bar">
            <!-- Region Filter -->
            <select id="mapFilterRegion" class="map-filter-select" onchange="filterMapMarkers()">
                <option value="">Barcha hududlar</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->name == 'Toshkent shahar' ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>

            <!-- Category / Transaction Type Filter -->
            <select id="mapFilterCategory" class="map-filter-select" onchange="filterMapMarkers()">
                <option value="">Barcha turlar (Sotuv/Ijara)</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Center to Tashkent Button -->
            <button type="button" onclick="centerToTashkent()" class="btn-filter-settings" style="height: 38px; padding: 0 14px; font-size: 13px; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fas fa-crosshairs text-[#0084ff]"></i>
                <span>Toshkent</span>
            </button>
        </div>
    </div>

    <!-- Map Body Container -->
    <div class="map-body-container">
        <!-- Floating Result Counter -->
        <div class="map-floating-badge">
            <i class="fas fa-building" style="color: #0084ff;"></i>
            <span>Xaritada: <strong id="visibleCountDisplay" style="color: #0084ff;">{{ count($mapProducts) }}</strong> ta e'lon</span>
        </div>

        <!-- Leaflet Map Container -->
        <div id="fullscreenEstoraMap"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rawMapProducts = @json($mapProducts ?? []);
    let map = null;
    let markersLayer = L.layerGroup();

    // 1. Initialize Leaflet Map - Centered on Tashkent (default)
    const tashkentCenter = [41.2995, 69.2401];
    map = L.map('fullscreenEstoraMap').setView(tashkentCenter, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    markersLayer.addTo(map);

    // Render Markers Function
    window.renderMarkers = function(products) {
        markersLayer.clearLayers();
        const bounds = [];

        products.forEach(item => {
            if (item.lat && item.lng) {
                bounds.push([item.lat, item.lng]);

                const customIcon = L.divIcon({
                    className: 'custom-map-div-icon',
                    html: `<div class="custom-map-price-badge">${item.price}</div>`,
                    iconSize: [80, 32],
                    iconAnchor: [40, 16]
                });

                const marker = L.marker([item.lat, item.lng], { icon: customIcon });

                const popupHtml = `
                    <div class="map-popup-card">
                        <img src="${item.image}" class="map-popup-img" onerror="this.src='/images/hero.png'">
                        <div class="map-popup-price">${item.price}</div>
                        <div class="map-popup-title">${item.name}</div>
                        <div class="map-popup-meta">
                            <i class="fas fa-location-dot" style="color: #ef4444;"></i>
                            <span>${item.region || ''}, ${item.city || ''}</span>
                        </div>
                        <a href="${item.url}" class="map-popup-btn" target="_blank">E'lonni ochish</a>
                    </div>
                `;

                marker.bindPopup(popupHtml);
                markersLayer.addLayer(marker);
            }
        });

        document.getElementById('visibleCountDisplay').textContent = products.length;

        // Agar Toshkent filter tanlangan bo'lsa yoki Tashkentda elementlar bo'lsa
        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
        } else {
            map.setView(tashkentCenter, 12);
        }
    };

    // Filter Markers Function
    window.filterMapMarkers = function() {
        const selectedRegion = document.getElementById('mapFilterRegion').value;
        const selectedCategory = document.getElementById('mapFilterCategory').value;

        const filtered = rawMapProducts.filter(item => {
            let matchRegion = true;
            let matchCategory = true;

            if (selectedRegion) {
                matchRegion = item.region_id == selectedRegion;
            }
            if (selectedCategory) {
                matchCategory = item.category_id == selectedCategory;
            }

            return matchRegion && matchCategory;
        });

        window.renderMarkers(filtered);
    };

    // Center to Tashkent helper
    window.centerToTashkent = function() {
        map.setView(tashkentCenter, 12, { animate: true });
    };

    // Initial render
    window.filterMapMarkers();
});
</script>
@endsection
