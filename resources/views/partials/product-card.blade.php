@php
    $images = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
    $firstImg = !empty($images) ? $images[0] : '/images/hero.png';
    if (!str_starts_with($firstImg, 'http') && !str_starts_with($firstImg, '/')) {
        $firstImg = '/storage/' . $firstImg;
    }
@endphp

<div class="listing-card">
    <div class="listing-img-wrapper">
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

    <div class="listing-details">
        <div class="listing-header-row">
            <span class="listing-price">{{ number_format($product->price) }} USD</span>
            <span style="font-size: 11px; font-weight: 700; color: #64748b;">ID {{ 10000 + $product->id }}</span>
        </div>

        <a href="{{ route('products.show', $product->id) }}">
            <h3 class="listing-title">{{ $product->name ?? ($product->subCategory->name . ' - ' . $product->square . ' m²') }}</h3>
        </a>

        <div class="listing-location">
            <i class="fas fa-map-marker-alt" style="color: var(--accent-orange);"></i>
            <span>{{ $product->region->name ?? 'Toshkent' }}, {{ $product->city->name ?? '' }}</span>
        </div>

        <div class="listing-specs">
            @if($product->rooms)
                <span><i class="fas fa-door-open" style="color: var(--accent-blue);"></i> {{ $product->rooms }} xona</span>
            @endif
            @if($product->square)
                <span><i class="fas fa-ruler-combined" style="color: var(--accent-blue);"></i> {{ $product->square }} m²</span>
            @endif
            @if($product->floor)
                <span><i class="fas fa-building" style="color: var(--accent-blue);"></i> {{ $product->floor }}/{{ $product->building_floor ?? '—' }} qavat</span>
            @endif
        </div>

        <div class="listing-tags">
            @if($product->metros && count($product->metros) > 0)
                <span class="listing-tag" style="color: #0284c7; background: #e0f2fe;">
                    <i class="fas fa-subway"></i> {{ $product->metros[0]->name }}
                </span>
            @endif
            @if($product->universities && count($product->universities) > 0)
                <span class="listing-tag" style="color: #b45309; background: #fef3c7;">
                    <i class="fas fa-graduation-cap"></i> {{ Str::limit($product->universities[0]->name, 18) }}
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
