@extends('layouts.admin')

@section('title', 'E\'lonni Tahrirlash')
@section('header_title', 'E\'lonni Tahrirlash')

@section('content')
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
        backdrop-blur: 2px;
    }
    .image-preview-card:hover .image-preview-overlay {
        opacity: 1;
    }
</style>

<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
        <a href="{{ route('admin.products') }}" class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="font-display font-bold text-lg text-[#061c3f]">E'lonni Tahrirlash</h2>
            <p class="text-xs text-gray-400">Ko'chmas mulk e'loni ma'lumotlarini o'zgartirish bosqichlari</p>
        </div>
    </div>

    <!-- Stepper Navigation -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <div class="relative flex items-center justify-between w-full max-w-3xl mx-auto">
            <!-- Progress Line Background -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-gray-100 rounded-full z-0"></div>
            <!-- Active Progress Line -->
            <div id="step-progress-line" class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-[#0084ff] rounded-full z-0 transition-all duration-500" style="width: 0%;"></div>

            <!-- Step 1 Indicator -->
            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(1)">
                <div id="step-circle-1" class="w-10 h-10 rounded-full bg-[#0084ff] text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-lg transition-all duration-300">
                    1
                </div>
                <span id="step-label-1" class="text-xs font-bold text-[#061c3f] mt-2 transition-all duration-300">Asosiy ma'lumotlar</span>
            </div>

            <!-- Step 2 Indicator -->
            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(2)">
                <div id="step-circle-2" class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300">
                    2
                </div>
                <span id="step-label-2" class="text-xs font-semibold text-gray-400 mt-2 transition-all duration-300">E'lon Rasmlari</span>
            </div>

            <!-- Step 3 Indicator -->
            <div class="step-indicator-item relative z-10 flex flex-col items-center group cursor-pointer" onclick="goToStep(3)">
                <div id="step-circle-3" class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300">
                    3
                </div>
                <span id="step-label-3" class="text-xs font-semibold text-gray-400 mt-2 transition-all duration-300">Manzil va Tavsif</span>
            </div>

            <!-- Step 4 Indicator -->
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

        <form id="product-wizard-form" action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Hidden Inputs to Store Base64 Image Order -->
            <div id="hidden-images-container"></div>

            <!-- STEP 1: ASOSIY MA'LUMOTLAR -->
            <div id="step-content-1" class="step-content-pane space-y-6 transition-all duration-350 transform opacity-100 scale-100">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">1-bosqich: Sarlavha, Narx va Kategoriya</h3>
                    <p class="text-xs text-gray-400">E'lonning asosiy tafsilotlarini belgilang</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">E'lon Sarlavhasi (Nomi)</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: Chilonzorda 3 xonali kvartira sotiladi">
                    </div>
                    <div>
                        <label for="price" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Narxi (UZS)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="any"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: 550000000">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Asosiy Kategoriya</label>
                        <select name="category_id" id="category_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                            <option value="">Kategoriyani tanlang</option>
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
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                            <option value="">Avval asosiy kategoriyani tanlang</option>
                            @foreach($categories as $category)
                                @foreach($category->subCategories as $sub)
                                    <option value="{{ $sub->id }}" data-category-id="{{ $category->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }} style="display: none;">
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
                    <h3 class="font-display font-bold text-base text-[#061c3f]">2-bosqich: Rasmlarni yuklash va tartibga solish</h3>
                    <p class="text-xs text-gray-400">Rasmlarni yuklang, ularning tartibini o'zgartirish uchun o'q tugmalaridan foydalaning (Birinchi rasm asosiy rasm hisoblanadi)</p>
                </div>

                <!-- Drag & Drop Area -->
                <div id="drop-zone" class="border-2 border-dashed border-gray-300 hover:border-[#0084ff] bg-gray-50/50 hover:bg-blue-50/10 rounded-2xl p-8 flex flex-col items-center justify-center cursor-pointer transition-all duration-200 group">
                    <div class="w-14 h-14 rounded-full bg-white border border-gray-100 shadow-sm flex items-center justify-center text-[#0084ff] text-xl mb-4 group-hover:scale-110 transition-transform duration-200">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Rasmlarni yuklash uchun bosing yoki shu yerga tortib olib keling</p>
                    <p class="text-xs text-gray-400 mt-1">JPEG, PNG formatlar, maksimal 5MB har biri</p>
                    <input type="file" id="file-selector" multiple accept="image/*" class="hidden">
                </div>

                <!-- Preview Gallery Grid -->
                <div id="images-preview-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-4">
                    <!-- Dynamic preview cards generated in JS -->
                </div>
            </div>

            <!-- STEP 3: MANZIL VA TAVSIF -->
            <div id="step-content-3" class="step-content-pane space-y-6 hidden transform opacity-0 scale-95 transition-all duration-350">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">3-bosqich: Manzil, Aloqa va Tavsif</h3>
                    <p class="text-xs text-gray-400">Mulkning joylashuvu va uning batafsil tavsifini yozing</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="region_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Viloyat / Viloyat darajasidagi shahar</label>
                        <select name="region_id" id="region_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                            <option value="">Viloyatni tanlang</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region_id', $product->region_id) == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="city_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tuman / Shahar</label>
                        <select name="city_id" id="city_id" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                            <option value="">Avval viloyatni tanlang</option>
                            @foreach($regions as $region)
                                @foreach($region->cities as $city)
                                    <option value="{{ $city->id }}" data-region-id="{{ $region->id }}" {{ old('city_id', $product->city_id) == $city->id ? 'selected' : '' }} style="display: none;">
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Bog'lanish uchun telefon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $product->phone) }}" required
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: +998901234567">
                    </div>
                    <div>
                        <label for="landmark" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mo'ljal (Landmark - Ixtiyoriy)</label>
                        <input type="text" name="landmark" id="landmark" value="{{ old('landmark', $product->landmark) }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: Korzinka yaqinida">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tavsif (Description)</label>
                    <textarea name="description" id="description" rows="4" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="E'lon haqida batafsil ma'lumot kiriting...">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <!-- STEP 4: PARAMETRLAR VA QULAYLIKLAR -->
            <div id="step-content-4" class="step-content-pane space-y-6 hidden transform opacity-0 scale-95 transition-all duration-350">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="font-display font-bold text-base text-[#061c3f]">4-bosqich: Parametrlar va Qo'shimcha qulayliklar</h3>
                    <p class="text-xs text-gray-400">Xonalar soni, maydoni va boshqa qo'shimcha imkoniyatlarni tanlang</p>
                </div>

                <!-- Parameters Grid (Custom 3 Columns layout - FIXED) -->
                <div class="grid-parameters bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                    <div>
                        <label for="rooms" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Xonalar</label>
                        <input type="number" name="rooms" id="rooms" value="{{ old('rooms', $product->rooms) }}" required min="0"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                            placeholder="3">
                    </div>
                    <div>
                        <label for="square" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Maydoni (m²)</label>
                        <input type="number" name="square" id="square" value="{{ old('square', $product->square) }}" required min="0"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                            placeholder="75">
                    </div>
                    <div>
                        <label for="floor" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Qavat</label>
                        <input type="number" name="floor" id="floor" value="{{ old('floor', $product->floor) }}" min="0"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                            placeholder="4">
                    </div>
                    <div>
                        <label for="building_floor" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Qavatligi</label>
                        <input type="number" name="building_floor" id="building_floor" value="{{ old('building_floor', $product->building_floor) }}" min="0"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                            placeholder="9">
                    </div>
                    <div>
                        <label for="repair" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ta'miri</label>
                        <select name="repair" id="repair"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm">
                            <option value="">Tanlang</option>
                            <option value="Evro" {{ old('repair', $product->repair) == 'Evro' ? 'selected' : '' }}>Evro</option>
                            <option value="O'rtacha" {{ old('repair', $product->repair) == "O'rtacha" ? 'selected' : '' }}>O'rtacha</option>
                            <option value="Ta'mirtalab" {{ old('repair', $product->repair) == 'Ta\'mirtalab' ? 'selected' : '' }}>Ta'mirtalab</option>
                            <option value="Qora suvoq" {{ old('repair', $product->repair) == 'Qora suvoq' ? 'selected' : '' }}>Qora suvoq</option>
                        </select>
                    </div>
                    <div>
                        <label for="sotix" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sotix (Hovli)</label>
                        <input type="number" name="sotix" id="sotix" value="{{ old('sotix', $product->sotix) }}" min="0"
                            class="block w-full px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] transition-all text-sm"
                            placeholder="6">
                    </div>
                </div>

                <!-- Deal Options -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-t border-b border-gray-100 py-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="exchange" value="1" {{ old('exchange', $product->exchange) ? 'checked' : '' }}
                            class="w-5 h-5 rounded-lg border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                        <div>
                            <span class="block text-sm font-semibold text-gray-700">Ayirboshlash bor (Exchange)</span>
                            <span class="block text-xs text-gray-400">Boshqa mulkka almashtirish</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="pay_in_installments" value="1" {{ old('pay_in_installments', $product->pay_in_installments) ? 'checked' : '' }}
                            class="w-5 h-5 rounded-lg border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                        <div>
                            <span class="block text-sm font-semibold text-gray-700">Bo'lib to'lash (Installments)</span>
                            <span class="block text-xs text-gray-400">Bo'lib to'lash imkoniyati bor</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="credit" value="1" {{ old('credit', $product->credit) ? 'checked' : '' }}
                            class="w-5 h-5 rounded-lg border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                        <div>
                            <span class="block text-sm font-semibold text-gray-700">Kreditga sotiladi (Credit)</span>
                            <span class="block text-xs text-gray-400">Ipoteka / Bank krediti</span>
                        </div>
                    </label>
                </div>

                <!-- Extra Items -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Qulayliklari (Amenities / Items)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                        @foreach($defaultItems as $item)
                            <label class="flex items-center gap-3 cursor-pointer p-2 hover:bg-white rounded-lg transition-all border border-transparent hover:border-gray-200">
                                <input type="checkbox" name="items[]" value="{{ $item->name }}"
                                    {{ is_array(old('items', $selectedItems)) && in_array($item->name, old('items', $selectedItems)) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded border-gray-300 text-[#0084ff] focus:ring-[#0084ff]">
                                <span class="text-xs font-medium text-gray-700">{{ $item->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Wizard Footer Action Buttons -->
            <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                <!-- Back / Cancel Button -->
                <div>
                    <button type="button" id="btn-prev" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold text-sm rounded-xl transition-all hidden" onclick="navigateStep(-1)">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Orqaga
                    </button>
                    <a href="{{ route('admin.products') }}" id="btn-cancel" class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl transition-all">
                        Bekor qilish
                    </a>
                </div>

                <!-- Next / Submit Button -->
                <div class="flex items-center gap-3">
                    <button type="button" id="btn-next" class="px-6 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm rounded-xl shadow-lg shadow-blue-500/20 transition-all" onclick="navigateStep(1)">
                        Keyingisi <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                    <button type="submit" id="btn-submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-emerald-500/20 transition-all hidden">
                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> O'zgarishlarni Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 4;
    let uploadedImages = []; // List of base64 strings or storage URLs

    // Render Preview Gallery
    function renderGallery() {
        const grid = document.getElementById('images-preview-grid');
        const container = document.getElementById('hidden-images-container');
        
        grid.innerHTML = '';
        container.innerHTML = '';

        if (uploadedImages.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-8 text-center text-gray-400 text-sm">
                    Yuklangan rasmlar yo'q
                </div>
            `;
            return;
        }

        uploadedImages.forEach((imgSrc, index) => {
            // 1. Create hidden input for form submission
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'images[]';
            input.value = imgSrc;
            container.appendChild(input);

            // 2. Create UI preview card
            const card = document.createElement('div');
            card.className = 'image-preview-card';
            
            // Check if primary
            const badge = index === 0 
                ? '<span class="absolute top-2 left-2 px-2 py-0.5 rounded-md bg-emerald-500 text-white font-bold text-[9px] uppercase tracking-wider z-20">Asosiy</span>' 
                : '';

            card.innerHTML = `
                ${badge}
                <img src="${imgSrc}" class="w-full h-full object-cover relative z-10" />
                <div class="image-preview-overlay z-20">
                    <button type="button" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-sm transition-all" onclick="moveImage(${index}, -1)" ${index === 0 ? 'disabled style="opacity: 0.3;"' : ''}>
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button type="button" class="w-8 h-8 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center text-sm transition-all" onclick="deleteImage(${index})">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    <button type="button" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-sm transition-all" onclick="moveImage(${index}, 1)" ${index === uploadedImages.length - 1 ? 'disabled style="opacity: 0.3;"' : ''}>
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
        
        // Swap elements
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
                circle.className = "w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-md transition-all duration-300";
                circle.innerHTML = '<i class="fa-solid fa-check text-xs"></i>';
                label.className = "text-xs font-semibold text-emerald-600 mt-2 transition-all duration-300";
            } else if (i === currentStep) {
                circle.className = "w-10 h-10 rounded-full bg-[#0084ff] text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow-lg scale-110 transition-all duration-300";
                circle.innerHTML = i;
                label.className = "text-xs font-bold text-[#061c3f] mt-2 transition-all duration-300";
            } else {
                circle.className = "w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-sm border-4 border-white shadow-sm transition-all duration-300";
                circle.innerHTML = i;
                label.className = "text-xs font-semibold text-gray-400 mt-2 transition-all duration-300";
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

    function validateCurrentStepInputs() {
        const pane = document.getElementById(`step-content-${currentStep}`);
        const inputs = pane.querySelectorAll('input, select, textarea');
        
        let isValid = true;
        for (let i = 0; i < inputs.length; i++) {
            if (!inputs[i].reportValidity()) {
                isValid = false;
                break;
            }
        }
        return isValid;
    }

    function navigateStep(direction) {
        if (direction === 1 && !validateCurrentStepInputs()) {
            return;
        }

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
            }, 20);

            updateStepIndicator();
        }, 300);
    }

    function goToStep(step) {
        if (step === currentStep) return;
        if (step > currentStep) {
            while (currentStep < step) {
                if (!validateCurrentStepInputs()) {
                    return;
                }
                navigateStep(1);
            }
        } else {
            navigateStep(step - currentStep);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Drag & Drop Area listeners
        const dropZone = document.getElementById('drop-zone');
        const fileSelector = document.getElementById('file-selector');

        dropZone.addEventListener('click', () => fileSelector.click());
        fileSelector.addEventListener('change', () => handleFiles(fileSelector.files));

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-[#0084ff]', 'bg-blue-50/10');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-[#0084ff]', 'bg-blue-50/10');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-[#0084ff]', 'bg-blue-50/10');
            handleFiles(e.dataTransfer.files);
        });

        // Categories and Subcategories filtering
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
        const subcategoryOptions = subcategorySelect.querySelectorAll('option[data-category-id]');

        categorySelect.addEventListener('change', () => {
            const selectedCategoryId = categorySelect.value;
            subcategorySelect.value = '';
            
            if (selectedCategoryId === '') {
                subcategorySelect.innerHTML = '<option value="">Avval asosiy kategoriyani tanlang</option>';
                return;
            }

            let hasVisibleOptions = false;
            subcategoryOptions.forEach(option => {
                if (option.getAttribute('data-category-id') === selectedCategoryId) {
                    option.style.display = '';
                    if (!hasVisibleOptions) {
                        subcategorySelect.innerHTML = '<option value="">Sub-kategoriyani tanlang</option>';
                        hasVisibleOptions = true;
                    }
                    subcategorySelect.appendChild(option);
                } else {
                    option.style.display = 'none';
                }
            });
        });

        // Regions and Cities filtering
        const regionSelect = document.getElementById('region_id');
        const citySelect = document.getElementById('city_id');
        const cityOptions = citySelect.querySelectorAll('option[data-region-id]');

        regionSelect.addEventListener('change', () => {
            const selectedRegionId = regionSelect.value;
            citySelect.value = '';

            if (selectedRegionId === '') {
                citySelect.innerHTML = '<option value="">Avval viloyatni tanlang</option>';
                return;
            }

            let hasVisibleOptions = false;
            cityOptions.forEach(option => {
                if (option.getAttribute('data-region-id') === selectedRegionId) {
                    option.style.display = '';
                    if (!hasVisibleOptions) {
                        citySelect.innerHTML = '<option value="">Tuman/shaharni tanlang</option>';
                        hasVisibleOptions = true;
                    }
                    citySelect.appendChild(option);
                } else {
                    option.style.display = 'none';
                }
            });
        });

        // Trigger change to restore values on page load
        if (categorySelect.value !== '') {
            categorySelect.dispatchEvent(new Event('change'));
            subcategorySelect.value = "{{ old('subcategory_id', $product->subcategory_id) }}";
        }
        if (regionSelect.value !== '') {
            regionSelect.dispatchEvent(new Event('change'));
            citySelect.value = "{{ old('city_id', $product->city_id) }}";
        }

        // Initialize images from old input OR existing product images
        @if(is_array(old('images')))
            uploadedImages = {!! json_encode(old('images')) !!};
        @else
            uploadedImages = {!! json_encode($product->images ?? []) !!};
        @endif

        renderGallery();
        updateStepIndicator();
    });
</script>
@endsection
