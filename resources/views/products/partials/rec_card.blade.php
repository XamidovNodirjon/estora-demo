<div class="listing-card">
    <div class="listing-img-wrapper">
        @php
            $recImages = $product->images;
            if (is_string($recImages)) {
                $recImages = json_decode($recImages, true);
            }
            $recImages = is_array($recImages) ? $recImages : [];
        @endphp
        
        @if(count($recImages) > 0)
            <img src="{{ Str::startsWith($recImages[0], 'http') ? $recImages[0] : (Str::startsWith($recImages[0], '/storage') ? $recImages[0] : (Str::startsWith($recImages[0], 'storage') ? '/' . $recImages[0] : '/storage/' . $recImages[0])) }}" alt="{{ $product->name }}">
        @else
            <img src="/images/apartment1.png" alt="Placeholder">
        @endif
        
        <span class="badge-top">TOP</span>
        <div class="btn-favorite js-favorite-btn" data-id="{{ $product->id }}" style="cursor: pointer;"><i class="{{ Auth::check() && $product->isFavoritedBy(Auth::user()) ? 'fas fa-heart text-red-500' : 'far fa-heart' }}"></i></div>
        @if($product->exchange)
            <span class="badge-promo yaxshi-taklif">Yaxshi Taklif</span>
        @endif
    </div>
    <div class="listing-details">
        <div class="listing-header-row">
            <span class="listing-price">{{ number_format($product->price) }} USD</span>
            <span class="listing-date">{{ $product->created_at->diffForHumans() }}</span>
        </div>
        <h3 class="listing-title">
            <a href="{{ route('products.show', $product->id) }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                {{ $product->name }}
            </a>
        </h3>
        <p class="listing-location">{{ $product->region->name ?? '' }}, {{ $product->city->name ?? '' }}</p>
        
        <div class="listing-specs">
            <div class="spec-item"><i class="fas fa-building"></i> {{ $product->floor ?? '—' }}/{{ $product->building_floor ?? '—' }} etaj</div>
            <div class="spec-item"><i class="fas fa-door-open"></i> {{ $product->rooms ?? '—' }} xona</div>
            <div class="spec-item"><i class="fas fa-ruler-combined"></i> {{ $product->square ?? '—' }}m²</div>
        </div>
        <div class="listing-tags">
            @if($product->repair)
                <span class="listing-tag repair"><i class="fas fa-tools"></i> {{ $product->repair }}</span>
            @endif
            @if(count($product->metros) > 0)
                <span class="listing-tag metro"><i class="fas fa-subway"></i> {{ $product->metros[0]->name }} Metro</span>
            @endif
        </div>
    </div>
</div>
