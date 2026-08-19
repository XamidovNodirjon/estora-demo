@php
    $images = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
    $firstImg = !empty($images) ? $images[0] : '/images/hero-villa.png';
    if (!str_starts_with($firstImg, 'http') && !str_starts_with($firstImg, '/')) {
        $firstImg = '/storage/' . $firstImg;
    }
    $phone = $product->phone ?? $product->user->phone ?? '+998 95 160 64 46';
@endphp

<div class="product-row-card">
    <!-- Thumbnail Image -->
    <div class="product-row-thumb">
        <a href="{{ route('products.show', $product->id) }}">
            <img src="{{ $firstImg }}" alt="{{ $product->name }}" loading="lazy">
        </a>

        @if($product->is_top)
            <span class="badge-top">TOP</span>
        @endif

        <button type="button" 
                class="btn-favorite fav-btn-{{ $product->id }} {{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'active' : '' }}" 
                onclick="toggleFavorite({{ $product->id }}, event)" 
                title="Saralanganlarga qo'shish">
            <i class="{{ auth()->check() && $product->isFavoritedBy(auth()->user()) ? 'fas' : 'far' }} fa-heart"></i>
        </button>
    </div>

    <!-- Center Info -->
    <div class="product-row-info">
        <div>
            <div class="product-row-header">
                <span class="product-row-price">{{ number_format($product->price) }} USD</span>
                <span class="product-row-id">ID {{ 10000 + $product->id }}</span>
            </div>

            <h3 class="product-row-title">
                <a href="{{ route('products.show', $product->id) }}">
                    {{ $product->name ?? ($product->subCategory->name . ' - ' . $product->square . ' m²') }}
                </a>
            </h3>

            <div class="product-row-location">
                <i class="fas fa-map-marker-alt" style="color: var(--accent-orange);"></i>
                <span>{{ $product->region->name ?? 'Toshkent shahri' }}, {{ $product->city->name ?? 'Mirobod tumani' }}</span>
            </div>
        </div>

        <div>
            <div class="product-row-specs">
                @if($product->rooms)
                    <span><i class="fas fa-door-open"></i> {{ $product->rooms }} xona</span>
                @endif
                @if($product->square)
                    <span><i class="fas fa-ruler-combined"></i> {{ $product->square }} m²</span>
                @endif
                @if($product->floor)
                    <span><i class="fas fa-building"></i> {{ $product->floor }}/{{ $product->building_floor ?? '—' }} qavat</span>
                @endif
            </div>

            <div class="product-row-tags">
                @if($product->metros && count($product->metros) > 0)
                    <span class="listing-tag" style="color: #0284c7; background: #e0f2fe;">
                        <i class="fas fa-subway"></i> {{ $product->metros[0]->name }}
                    </span>
                @endif
                @if($product->universities && count($product->universities) > 0)
                    <span class="listing-tag" style="color: #b45309; background: #fef3c7;">
                        <i class="fas fa-graduation-cap"></i> {{ Str::limit($product->universities[0]->name, 22) }}
                    </span>
                @endif
                @if($product->repair)
                    <span class="listing-tag" style="color: #475569; background: #f1f5f9;">
                        {{ $product->repair }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Actions -->
    <div class="product-row-actions">
        <div style="font-size: 11.5px; color: #94a3b8; font-weight: 600;">
            {{ $product->created_at ? $product->created_at->diffForHumans() : 'Yangi e\'lon' }}
        </div>

        <div style="display: flex; flex-direction: column; gap: 8px; width: 100%;">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="btn-contact-agent" style="justify-content: center; width: 100%;">
                <i class="fas fa-phone-alt"></i>
                <span>Qo'ng'iroq qilish</span>
            </a>
            <a href="{{ route('products.show', $product->id) }}" class="btn-action-id-search" style="justify-content: center; width: 100%; height: 36px; font-size: 12.5px;">
                <span>Batafsil ko'rish</span>
            </a>
        </div>
    </div>
</div>
