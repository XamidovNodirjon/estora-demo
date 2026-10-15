{{-- Vertikal e'lon kartasi (Tailwind): makler sahifasi va sevimlilar uchun --}}
@php
    $cardImages = is_array($product->images) ? $product->images : (json_decode($product->images ?? '[]', true) ?: []);
    $cardImage = $cardImages[0] ?? null;
    if ($cardImage && !\Illuminate\Support\Str::startsWith($cardImage, ['http', '/'])) {
        $cardImage = '/storage/' . $cardImage;
    }

    $dealLabels = ['Sotuv' => 'Sotiladi', 'Ijara' => 'Ijaraga beriladi'];
    $cardCategory = $product->category->name ?? null;
    $cardTitle = trim(($product->subCategory->name ?? '') . ' ' . ($dealLabels[$cardCategory] ?? $cardCategory ?? ''))
        ?: ($product->name ?? "E'lon");
    $cardAddress = $product->name
        ?: collect([$product->region->name ?? null, $product->city->name ?? null, $product->landmark])->filter()->implode(', ');
    $isFavorite = auth()->check() && $product->isFavoritedBy(auth()->user());
@endphp

<div class="group bg-white border border-[#0077FE] rounded-xl overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
    <div class="relative h-[130px] bg-slate-100 border-b border-[#0077FE]">
        <a href="{{ route('products.show', $product->id) }}" class="block w-full h-full">
            @if($cardImage)
                <img src="{{ $cardImage }}" alt="{{ $cardTitle }}" loading="lazy" class="w-full h-full object-cover">
            @else
                <span class="w-full h-full flex items-center justify-center text-slate-400 text-3xl">
                    <i class="fa-regular fa-image"></i>
                </span>
            @endif
        </a>

        @if($product->is_top)
            <span class="absolute top-2 left-2 bg-amber-400 text-white text-[10px] font-black px-1.5 py-0.5 rounded flex items-center gap-1">
                <i class="fa-solid fa-crown text-[9px]"></i> TOP
            </span>
        @endif

        <button type="button" onclick="toggleFavorite({{ $product->id }}, event)"
                class="fav-btn-{{ $product->id }} absolute top-2 right-2 w-6 h-6 flex items-center justify-center text-amber-500 cursor-pointer {{ $isFavorite ? 'active' : '' }}"
                title="Sevimlilarga qo'shish">
            @if($isFavorite)
                <i class="fas fa-heart" style="color: #ef4444;"></i>
            @else
                <i class="far fa-heart"></i>
            @endif
        </button>
    </div>

    <div class="p-3 flex flex-col gap-1.5 flex-1">
        <div class="flex items-center justify-between gap-2">
            <span class="font-black text-[#0077FE] text-sm">{{ number_format((float) $product->price, 0, '', '.') }} y.e</span>
            <span class="text-[10px] font-semibold text-slate-600 border border-slate-300 rounded px-1.5 py-0.5 whitespace-nowrap">
                <i class="fa-regular fa-calendar text-[9px]"></i> {{ $product->created_at?->diffForHumans() }}
            </span>
        </div>

        <a href="{{ route('products.show', $product->id) }}" class="font-extrabold text-slate-900 text-[13px] leading-tight hover:text-[#0077FE] line-clamp-1">
            {{ $cardTitle }}
        </a>
        <p class="text-[10.5px] text-slate-500 leading-snug line-clamp-2 min-h-[28px]">{{ $cardAddress }}</p>

        <div class="flex items-center justify-between gap-1 text-[10px] font-semibold text-slate-600 border-t border-slate-300 pt-2 mt-auto">
            <span><i class="fa-solid fa-building text-slate-500"></i> {{ $product->floor ?? '—' }}/{{ $product->building_floor ?? '—' }} etaj</span>
            <span><i class="fa-solid fa-door-open text-slate-500"></i> {{ $product->rooms ?? '—' }} xona</span>
            <span><i class="fa-solid fa-ruler-combined text-slate-500"></i> {{ $product->square ?? '—' }}m²</span>
        </div>

        <div class="flex items-center gap-3 text-[10px] font-semibold text-slate-600 border-t border-slate-300 pt-2">
            @if($product->repair)
                <span class="truncate"><i class="fa-solid fa-paint-roller text-slate-500"></i> {{ $product->repair }}</span>
            @endif
            @if($product->metros && $product->metros->count())
                <span class="truncate"><i class="fa-solid fa-train-subway text-slate-500"></i> {{ $product->metros->first()->name }} Metro</span>
            @endif
        </div>
    </div>
</div>
