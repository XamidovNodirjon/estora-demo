@extends('layouts.client')

@section('title', $product->name)

@section('content')
<!-- Leaflet Map CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="max-w-5xl mx-auto space-y-6">
    <!-- Navigation Back Header -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
        <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-[#0084ff] transition-all">
            <i class="fa-solid fa-arrow-left"></i> Bosh sahifaga qaytish
        </a>

        @if($isOwner)
            <div class="flex items-center gap-3">
                <a href="{{ route('client.products.edit', $product->id) }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition-all">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Tahrirlash
                </a>
            </div>
        @endif
    </div>

    <!-- PRIVACY STATS CARD: Displayed strictly to the product owner -->
    @if($isOwner)
        <div class="bg-gradient-to-r from-blue-900 to-[#061c3f] rounded-2xl p-6 text-white shadow-md flex items-center justify-between border border-blue-800">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-white/10 text-cyan-400 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-blue-200">Maxsus statistika</span>
                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-bold border border-emerald-400/30">Faqat sizga ko'rinadi</span>
                    </div>
                    <h3 class="font-display font-bold text-2xl mt-0.5">{{ number_format($viewsCount, 0, ',', ' ') }} ta ko'rishlar</h3>
                </div>
            </div>
            <div class="text-right text-xs text-gray-300 hidden sm:block">
                <span>E'lon holati: </span>
                <span class="font-bold text-emerald-400">Faol</span>
            </div>
        </div>
    @endif

    <!-- Main Product Card -->
    <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm space-y-8">
        <!-- Title and Category Badges -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-3 py-1 rounded-full bg-[#0084ff]/10 text-[#0084ff] text-xs font-bold">
                        {{ $product->category->name ?? 'Kvartira' }}
                    </span>
                    @if($product->subCategory)
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">
                            {{ $product->subCategory->name }}
                        </span>
                    @endif
                </div>
                <h1 class="font-display font-extrabold text-2xl sm:text-3xl text-[#061c3f]">{{ $product->name }}</h1>
                <p class="text-xs text-gray-500 flex items-center gap-1 mt-2">
                    <i class="fa-solid fa-location-dot text-[#0084ff]"></i>
                    {{ $product->region->name ?? '' }}, {{ $product->city->name ?? '' }} 
                    @if($product->landmark) &bull; Mo'ljal: {{ $product->landmark }} @endif
                </p>
            </div>

            <div class="text-left md:text-right">
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">E'lon narxi</span>
                <div class="font-display font-black text-3xl text-[#0084ff]">
                    {{ number_format($product->price, 0, ',', ' ') }} <span class="text-lg font-bold text-gray-600">UZS</span>
                </div>
            </div>
        </div>

        <!-- Image Gallery Carousel / Grid -->
        <div>
            @if(!empty($product->images) && count($product->images) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2 h-80 sm:h-96 rounded-2xl overflow-hidden bg-gray-100 border border-gray-200">
                        <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-1 gap-4 max-h-96 overflow-y-auto">
                        @foreach(array_slice($product->images, 1) as $img)
                            <div class="h-44 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                <img src="{{ $img }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="h-64 rounded-2xl bg-gray-50 border border-dashed border-gray-200 flex items-center justify-center text-gray-400">
                    <i class="fa-solid fa-image text-4xl mr-2"></i> Rasmlar yo'q
                </div>
            @endif
        </div>

        <!-- Parameters Grid -->
        <div>
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-4">Asosiy parametrlar</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                    <span class="block text-xs text-gray-400 uppercase">Xonalar</span>
                    <span class="font-display font-bold text-xl text-[#061c3f]">{{ $product->rooms ?? '-' }} xona</span>
                </div>
                <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                    <span class="block text-xs text-gray-400 uppercase">Maydoni</span>
                    <span class="font-display font-bold text-xl text-[#061c3f]">{{ $product->square ?? '-' }} m²</span>
                </div>
                <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                    <span class="block text-xs text-gray-400 uppercase">Qavat</span>
                    <span class="font-display font-bold text-xl text-[#061c3f]">{{ $product->floor ?? '-' }} / {{ $product->building_floor ?? '-' }}</span>
                </div>
                <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                    <span class="block text-xs text-gray-400 uppercase">Ta'miri</span>
                    <span class="font-display font-bold text-xl text-[#061c3f]">{{ $product->repair ?? 'Mavjud emas' }}</span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div>
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-3">Tafsilotli tavsif</h3>
            <p class="text-gray-700 text-sm leading-relaxed bg-gray-50/50 p-6 rounded-2xl border border-gray-100 whitespace-pre-line">
                {{ $product->description }}
            </p>
        </div>

        <!-- Amenities / Items -->
        @if($product->items && count($product->items) > 0)
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] mb-3">Qulayliklar</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->items as $item)
                        <span class="px-3 py-1.5 rounded-xl bg-blue-50 text-[#0084ff] border border-blue-100 text-xs font-semibold flex items-center gap-1.5">
                            <i class="fa-solid fa-check text-xs"></i> {{ $item->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Contact & Map -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] mb-3">Sotuvchi va Aloqa</h3>
                <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#061c3f] text-white flex items-center justify-center font-bold text-lg font-display">
                            {{ strtoupper(substr($product->user->name ?? 'S', 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-[#061c3f] text-base">{{ $product->user->name ?? 'Sotuvchi' }}</h4>
                            <span class="text-xs text-gray-400">
                                {{ ($product->user->role?->name ?? $product->user->type) === 'makler' ? 'Makler (Rieltor)' : 'Uy egasi' }}
                            </span>
                        </div>
                    </div>

                    <a href="tel:{{ $product->phone }}" class="block text-center py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm transition-all shadow-md mt-4">
                        <i class="fa-solid fa-phone mr-2"></i> {{ $product->phone ?? '+998' }}
                    </a>
                </div>
            </div>

            <!-- Map View -->
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] mb-3">Xaritada Joylashuvi</h3>
                @if($product->latitude && $product->longitude)
                    <div id="show-map" class="w-full h-48 rounded-2xl border border-gray-200"></div>
                @else
                    <div class="h-48 rounded-2xl bg-gray-50 border border-dashed border-gray-200 flex items-center justify-center text-gray-400 text-xs">
                        Xaritada koordinata kiritilmagan
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($product->latitude && $product->longitude)
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const lat = {{ $product->latitude }};
        const lng = {{ $product->longitude }};
        const map = L.map('show-map').setView([lat, lng], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
        L.marker([lat, lng]).addTo(map).bindPopup('{{ $product->name }}').openPopup();
    });
</script>
@endif
@endsection
