@extends('layouts.client')

@section('title', 'E\'lonni Tahrirlash')

@section('content')
<!-- Leaflet Map CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    .grid-parameters {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.5rem;
    }
    @media (min-width: 640px) {
        .grid-parameters {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (min-width: 768px) {
        .grid-parameters {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    .image-preview-card {
        position: relative;
        aspect-ratio: 4 / 3;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e5e7eb;
        background-color: #f9fafb;
        transition: all 0.2s ease;
    }
    .image-preview-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #0084ff;
    }
    .image-preview-overlay {
        position: absolute;
        inset: 0;
        background-color: rgba(6, 28, 63, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .image-preview-card:hover .image-preview-overlay {
        opacity: 1;
    }
</style>

<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('client.dashboard') }}" class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h2 class="font-display font-bold text-lg text-[#061c3f]">E'lonni Tahrirlash</h2>
                <p class="text-xs text-gray-400">#{{ $product->id }} - {{ $product->name }}</p>
            </div>
        </div>

        <form action="{{ route('client.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Haqiqatdan ham ushbu e\'lonni o\'chirmoqchimisiz?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl text-xs font-bold transition-all">
                <i class="fa-solid fa-trash-can mr-1"></i> E'lonni o'chirish
            </button>
        </form>
    </div>

    <!-- Stepper Navigation -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <div class="relative flex items-center justify-between w-full max-w-3xl mx-auto">
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-100 rounded-full z-0"></div>
            <div id="step-progress-line" class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-[#0084ff] rounded-full z-0 transition-all duration-500" style="width: 0%;"></div>

            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(1)">
                <div id="step-circle-1" class="w-10 h-10 rounded-full bg-[#0084ff] text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-lg transition-all duration-300">
                    1
                </div>
                <span id="step-label-1" class="text-xs font-bold text-[#061c3f] mt-2 transition-all duration-300">Asosiy ma'lumotlar</span>
            </div>

            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(2)">
                <div id="step-circle-2" class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300">
                    2
                </div>
                <span id="step-label-2" class="text-xs font-semibold text-gray-400 mt-2 transition-all duration-300">E'lon Rasmlari</span>
            </div>

            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(3)">
                <div id="step-circle-3" class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300">
                    3
                </div>
                <span id="step-label-3" class="text-xs font-semibold text-gray-400 mt-2 transition-all duration-300">Manzil va Tavsif</span>
            </div>

            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(4)">
                <div id="step-circle-4" class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300">
                    4
                </div>
                <span id="step-label-4" class="text-xs font-semibold text-gray-400 mt-2 transition-all duration-300">Parametrlar & Qulayliklar</span>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm relative overflow-hidden">
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="product-wizard-form" action="{{ route('client.products.update', $product->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Hidden Inputs to Store Base64 Image Order -->
            <div id="hidden-images-container"></div>

            <!-- STEP 1: ASOSIY MA'LUMOTLAR -->
            <div id="step-content-1" class="step-content-pane space-y-6 transition-all duration-350 transform opacity-100 scale-100">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">1-bosqich: Sarlavha, Narx va Kategoriya</h3>
                    <p class="text-xs text-gray-400">E'loningiz sarlavhasi va narxini tahrirlang</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">E'lon Sarlavhasi</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] text-sm">
                    </div>
                    <div>
                        <label for="price" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Narxi (UZS)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="any"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Asosiy Kategoriya</label>
                        <select name="category_id" id="category_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] text-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="subcategory_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sub-kategoriya</label>
                        <select name="subcategory_id" id="subcategory_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] text-sm">
                            @foreach($categories as $category)
                                @foreach($category->subCategories as $sub)
                                    <option value="{{ $sub->id }}" data-category-id="{{ $category->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- STEP 2: E'LON RASMLARI -->
            <div id="step-content-2" class="step-content-pane space-y-6 hidden transform opacity-0 scale-95 transition-all duration-350">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">2-bosqich: Rasmlar</h3>
                    <p class="text-xs text-gray-400">Rasmlarni qayta yuklash va tartibga solish</p>
                </div>

                <div id="drop-zone" class="border-2 border-dashed border-gray-300 hover:border-[#0084ff] bg-gray-50/50 rounded-2xl p-8 flex flex-col items-center justify-center cursor-pointer transition-all duration-200">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-[#0084ff] mb-2"></i>
                    <p class="text-sm font-semibold text-gray-700">Yangi rasmlar qo'shish uchun bosing</p>
                    <input type="file" id="file-selector" multiple accept="image/*" class="hidden">
                </div>

                <div id="images-preview-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-4">
                </div>
            </div>

            <!-- STEP 3: MANZIL VA TAVSIF -->
            <div id="step-content-3" class="step-content-pane space-y-6 hidden transform opacity-0 scale-95 transition-all duration-350">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">3-bosqich: Manzil, Aloqa va Tavsif</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="region_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Viloyat</label>
                        <select name="region_id" id="region_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 text-sm">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" data-lat="{{ $region->lat }}" data-lng="{{ $region->long }}" {{ old('region_id', $product->region_id) == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="city_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tuman / Shahar</label>
                        <select name="city_id" id="city_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 text-sm">
                            @foreach($regions as $region)
                                @foreach($region->cities as $city)
                                    <option value="{{ $city->id }}" data-region-id="{{ $region->id }}" data-lat="{{ $city->lat }}" data-lng="{{ $city->long }}" {{ old('city_id', $product->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Metrolar (Yaqin metrolarni tanlang)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-48 overflow-y-auto p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                            @foreach($metros as $metro)
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 hover:bg-white rounded-lg transition-all border border-transparent">
                                    <input type="checkbox" name="metros[]" value="{{ $metro->id }}"
                                        {{ (is_array(old('metros')) && in_array($metro->id, old('metros'))) || (isset($selectedMetros) && in_array($metro->id, $selectedMetros)) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                                    <span class="text-xs font-medium text-gray-700">{{ $metro->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Universitetlar (Yaqin OOT larni tanlang)</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-48 overflow-y-auto p-3.5 rounded-xl bg-gray-50 border border-gray-200">
                            @foreach($universities as $university)
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 hover:bg-white rounded-lg transition-all border border-transparent">
                                    <input type="checkbox" name="universities[]" value="{{ $university->id }}"
                                        {{ (is_array(old('universities')) && in_array($university->id, old('universities'))) || (isset($selectedUniversities) && in_array($university->id, $selectedUniversities)) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                                    <span class="text-xs font-medium text-gray-700">{{ $university->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $product->phone) }}" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 text-sm">
                    </div>
                    <div>
                        <label for="landmark" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mo'ljal</label>
                        <input type="text" name="landmark" id="landmark" value="{{ old('landmark', $product->landmark) }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 text-sm">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Xarita</label>
                    <div id="map" class="w-full rounded-2xl border border-gray-200 bg-gray-50 relative z-10 shadow-sm" style="height: 300px;"></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $product->latitude) }}" readonly class="block w-full px-4 py-2 rounded-xl bg-gray-100 text-xs">
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $product->longitude) }}" readonly class="block w-full px-4 py-2 rounded-xl bg-gray-100 text-xs">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tavsif</label>
                    <textarea name="description" id="description" rows="4" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 text-sm">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- STEP 4: PARAMETRLAR -->
            <div id="step-content-4" class="step-content-pane space-y-6 hidden transform opacity-0 scale-95 transition-all duration-350">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">4-bosqich: Parametrlar va Qulayliklar</h3>
                </div>

                <div class="grid-parameters bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                    <div>
                        <label for="rooms" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Xonalar</label>
                        <input type="number" name="rooms" id="rooms" value="{{ old('rooms', $product->rooms) }}" required min="0" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label for="square" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Maydoni (m²)</label>
                        <input type="number" name="square" id="square" value="{{ old('square', $product->square) }}" required min="0" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label for="floor" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Qavat</label>
                        <input type="number" name="floor" id="floor" value="{{ old('floor', $product->floor) }}" min="0" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label for="building_floor" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Qavatligi</label>
                        <input type="number" name="building_floor" id="building_floor" value="{{ old('building_floor', $product->building_floor) }}" min="0" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                    </div>
                    <div>
                        <label for="repair" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ta'miri</label>
                        <select name="repair" id="repair" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                            <option value="">Tanlang</option>
                            <option value="Evro" {{ old('repair', $product->repair) == 'Evro' ? 'selected' : '' }}>Evro</option>
                            <option value="O'rtacha" {{ old('repair', $product->repair) == "O'rtacha" ? 'selected' : '' }}>O'rtacha</option>
                            <option value="Ta'mirtalab" {{ old('repair', $product->repair) == 'Ta\'mirtalab' ? 'selected' : '' }}>Ta'mirtalab</option>
                        </select>
                    </div>
                    <div>
                        <label for="sotix" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sotix</label>
                        <input type="number" name="sotix" id="sotix" value="{{ old('sotix', $product->sotix) }}" min="0" class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-sm">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Qulayliklar (Amenities)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                        @foreach($defaultItems as $item)
                            <label class="flex items-center gap-3 cursor-pointer p-2 hover:bg-white rounded-lg transition-all border border-transparent">
                                <input type="checkbox" name="items[]" value="{{ $item->name }}"
                                    {{ in_array($item->name, $selectedItems) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-300 text-[#0084ff]">
                                <span class="text-xs font-medium text-gray-700">{{ $item->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                <div>
                    <button type="button" id="btn-prev" class="px-5 py-2.5 bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl hidden" onclick="navigateStep(-1)">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Orqaga
                    </button>
                    <a href="{{ route('client.dashboard') }}" id="btn-cancel" class="px-5 py-2.5 bg-gray-50 text-gray-600 font-semibold text-sm rounded-xl">
                        Bekor qilish
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" id="btn-next" class="px-6 py-2.5 bg-[#0084ff] text-white font-semibold text-sm rounded-xl shadow-lg" onclick="navigateStep(1)">
                        Keyingisi <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                    <button type="submit" id="btn-submit" class="px-6 py-2.5 bg-emerald-600 text-white font-semibold text-sm rounded-xl shadow-lg hidden">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> O'zgarishlarni Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 4;
    let uploadedImages = @json($product->images ?? []);
    let map, marker;

    function renderGallery() {
        const grid = document.getElementById('images-preview-grid');
        const container = document.getElementById('hidden-images-container');
        grid.innerHTML = '';
        container.innerHTML = '';

        uploadedImages.forEach((imgBase64, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'images[]';
            input.value = imgBase64;
            container.appendChild(input);

            const card = document.createElement('div');
            card.className = 'image-preview-card';
            const badge = index === 0 ? '<span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-emerald-500 text-white font-bold text-[9px] uppercase z-20">Asosiy</span>' : '';

            card.innerHTML = `
                ${badge}
                <img src="${imgBase64}" class="w-full h-full object-cover relative z-10" />
                <div class="image-preview-overlay z-20">
                    <button type="button" class="w-8 h-8 rounded-full bg-white/10 text-white flex items-center justify-center text-sm" onclick="moveImage(${index}, -1)" ${index === 0 ? 'disabled style="opacity:0.3;"' : ''}>
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button type="button" class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-sm" onclick="deleteImage(${index})">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    <button type="button" class="w-8 h-8 rounded-full bg-white/10 text-white flex items-center justify-center text-sm" onclick="moveImage(${index}, 1)" ${index === uploadedImages.length - 1 ? 'disabled style="opacity:0.3;"' : ''}>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    function deleteImage(index) {
        uploadedImages.splice(index, 1);
        renderGallery();
    }

    function moveImage(index, direction) {
        const targetIndex = index + direction;
        if (targetIndex < 0 || targetIndex >= uploadedImages.length) return;
        const temp = uploadedImages[index];
        uploadedImages[index] = uploadedImages[targetIndex];
        uploadedImages[targetIndex] = temp;
        renderGallery();
    }

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.match('image.*')) continue;
            const reader = new FileReader();
            reader.onload = (e) => {
                uploadedImages.push(e.target.result);
                renderGallery();
            };
            reader.readAsDataURL(file);
        }
    }

    function updateStepIndicator() {
        const progressLine = document.getElementById('step-progress-line');
        const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressLine.style.width = `${percent}%`;

        for (let i = 1; i <= totalSteps; i++) {
            const circle = document.getElementById(`step-circle-${i}`);
            const label = document.getElementById(`step-label-${i}`);

            if (i < currentStep) {
                circle.className = "w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-md";
                circle.innerHTML = '<i class="fa-solid fa-check text-xs"></i>';
                label.className = "text-xs font-semibold text-emerald-600 mt-2";
            } else if (i === currentStep) {
                circle.className = "w-10 h-10 rounded-full bg-[#0084ff] text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-lg scale-110";
                circle.innerHTML = i;
                label.className = "text-xs font-bold text-[#061c3f] mt-2";
            } else {
                circle.className = "w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-sm";
                circle.innerHTML = i;
                label.className = "text-xs font-semibold text-gray-400 mt-2";
            }
        }

        const prevBtn = document.getElementById('btn-prev');
        const cancelBtn = document.getElementById('btn-cancel');
        const nextBtn = document.getElementById('btn-next');
        const submitBtn = document.getElementById('btn-submit');

        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
            cancelBtn.classList.remove('hidden');
        } else {
            prevBtn.classList.remove('hidden');
            cancelBtn.classList.add('hidden');
        }

        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }

    function navigateStep(direction) {
        const currentPane = document.getElementById(`step-content-${currentStep}`);
        currentPane.classList.remove('scale-100', 'opacity-100');
        currentPane.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            currentPane.classList.add('hidden');
            currentStep += direction;
            if (currentStep < 1) currentStep = 1;
            if (currentStep > totalSteps) currentStep = totalSteps;

            const nextPane = document.getElementById(`step-content-${currentStep}`);
            nextPane.classList.remove('hidden');
            
            setTimeout(() => {
                nextPane.classList.remove('scale-95', 'opacity-0');
                nextPane.classList.add('scale-100', 'opacity-100');
                if (currentStep === 3 && typeof map !== 'undefined') {
                    setTimeout(() => map.invalidateSize(), 100);
                }
            }, 20);

            updateStepIndicator();
        }, 300);
    }

    function goToStep(step) {
        if (step === currentStep) return;
        navigateStep(step - currentStep);
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderGallery();

        const dropZone = document.getElementById('drop-zone');
        const fileSelector = document.getElementById('file-selector');

        dropZone.addEventListener('click', () => fileSelector.click());
        fileSelector.addEventListener('change', () => handleFiles(fileSelector.files));

        const regionSelect = document.getElementById('region_id');
        const citySelect = document.getElementById('city_id');

        if (regionSelect && citySelect) {
            regionSelect.addEventListener('change', updateMapLocation);
            citySelect.addEventListener('change', updateMapLocation);
        }

        const initLat = {{ $product->latitude ?? 41.311081 }};
        const initLng = {{ $product->longitude ?? 69.240562 }};

        map = L.map('map').setView([initLat, initLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
        marker = L.marker([initLat, initLng], { draggable: true }).addTo(map);

        marker.on('dragend', function (e) {
            const latlng = marker.getLatLng();
            document.getElementById('latitude').value = latlng.lat.toFixed(6);
            document.getElementById('longitude').value = latlng.lng.toFixed(6);
        });

        map.on('click', function (e) {
            marker.setLatLng([e.latlng.lat, e.latlng.lng]);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });

        const uzCoordinates = {
            'toshkent shahar': [41.311081, 69.240562],
            'toshkent': [41.311081, 69.240562],
            'chilonzor': [41.2778, 69.2081],
            'yashnobod': [41.2917, 69.3242],
            'yunusobod': [41.3653, 69.2847],
            'mirzo ulug\'bek': [41.3325, 69.3402],
            'mirobod': [41.2958, 69.2789],
            'yakkasaroy': [41.2736, 69.2556],
            'shayxontohur': [41.3211, 69.2319],
            'olmazor': [41.3536, 69.2150],
            'sergeli': [41.2269, 69.2197],
            'yangihayot': [41.1969, 69.2097],
            'uchtepa': [41.2889, 69.1764],
            'samarqand': [39.6542, 66.9597],
            'buxoro': [39.7681, 64.4556],
            'andijon': [40.7821, 72.3442],
            'farg\'ona': [40.3842, 71.7843],
            'namangan': [41.0011, 71.6683],
            'qashqadaryo': [38.8606, 65.7890],
            'surxondaryo': [37.2242, 67.2783],
            'xorazm': [41.5569, 60.6317],
            'navoiy': [40.1039, 65.3688],
            'jizzax': [40.1158, 67.8422],
            'sirdaryo': [40.4947, 68.7797],
            'qoraqalpog\'iston': [43.7683, 59.0214]
        };

        function updateMapLocation() {
            let lat = null;
            let lng = null;
            let zoomLevel = 11;

            const selectedCityOption = citySelect.options[citySelect.selectedIndex];
            if (selectedCityOption && selectedCityOption.value) {
                const cLat = selectedCityOption.getAttribute('data-lat');
                const cLng = selectedCityOption.getAttribute('data-lng');
                const cityName = selectedCityOption.textContent.trim().toLowerCase();

                if (cLat && cLng && parseFloat(cLat) !== 0) {
                    lat = parseFloat(cLat);
                    lng = parseFloat(cLng);
                } else if (uzCoordinates[cityName]) {
                    lat = uzCoordinates[cityName][0];
                    lng = uzCoordinates[cityName][1];
                }
                zoomLevel = 13;
            }

            if (!lat || !lng) {
                const selectedRegionOption = regionSelect.options[regionSelect.selectedIndex];
                if (selectedRegionOption && selectedRegionOption.value) {
                    const rLat = selectedRegionOption.getAttribute('data-lat');
                    const rLng = selectedRegionOption.getAttribute('data-lng');
                    const regionName = selectedRegionOption.textContent.trim().toLowerCase();

                    if (rLat && rLng && parseFloat(rLat) !== 0) {
                        lat = parseFloat(rLat);
                        lng = parseFloat(rLng);
                    } else if (uzCoordinates[regionName]) {
                        lat = uzCoordinates[regionName][0];
                        lng = uzCoordinates[regionName][1];
                    } else {
                        for (const key in uzCoordinates) {
                            if (regionName.includes(key)) {
                                lat = uzCoordinates[key][0];
                                lng = uzCoordinates[key][1];
                                break;
                            }
                        }
                    }
                }
            }

            if (lat && lng && map && marker) {
                map.setView([lat, lng], zoomLevel);
                marker.setLatLng([lat, lng]);
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                setTimeout(() => map.invalidateSize(), 100);
            }
        }
    });
</script>
@endsection
