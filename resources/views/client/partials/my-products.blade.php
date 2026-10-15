{{--
    Mening e'lonlarim: status tablari, qidiruv, tur va saralash (brauzerda filtrlanadi).
    $limit - bosh sahifada nechta e'lon ko'rsatiladi (null = hammasi)
--}}
@php
    $limit = $limit ?? null;
    $knownStatuses = ['active', 'archived', 'negotiating', 'closed'];
    $statusOf = fn ($product) => in_array($product->status ?? 'active', $knownStatuses, true) ? ($product->status ?? 'active') : 'inactive';

    $tabs = [
        'all'         => 'Barchasi',
        'active'      => 'Faol',
        'inactive'    => 'Nofaol',
        'archived'    => 'Arxiv',
        'negotiating' => 'Kelishuvda',
        'closed'      => "Yopilgan e'lonlar",
    ];
    $tabCounts = ['all' => $userProducts->count()];
    foreach (array_keys($tabs) as $tab) {
        if ($tab !== 'all') {
            $tabCounts[$tab] = $userProducts->filter(fn ($p) => $statusOf($p) === $tab)->count();
        }
    }
    $categories = $userProducts->pluck('category.name')->filter()->unique()->values();
@endphp

<div class="cabinet-panel p-4 sm:p-5" data-my-products data-limit="{{ $limit ?? 0 }}">
    <div class="flex items-center justify-between gap-3">
        <h3 class="font-extrabold text-slate-900 text-sm">Mening e'lonlarim</h3>
        @if($limit)
            <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="text-[11px] font-bold text-[#0077FE] hover:underline flex items-center gap-1">
                Barchasini ko'rish <i class="fa-solid fa-arrow-right text-[9px]"></i>
            </a>
        @endif
    </div>

    <!-- Status tablari -->
    <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar mt-4 pb-3 border-b border-slate-300">
        @foreach($tabs as $key => $label)
            <button type="button" data-tab="{{ $key }}"
                    class="my-products-tab {{ $key === 'all' ? 'bg-[#0077FE] text-white border-[#0077FE]' : 'bg-white text-slate-700 border-slate-300 hover:border-[#0077FE]' }} border text-[10px] font-bold px-3 py-1.5 rounded-md whitespace-nowrap cursor-pointer transition-colors">
                {{ $label }} ({{ $tabCounts[$key] }})
            </button>
        @endforeach
    </div>

    <!-- Qidiruv va filtrlar -->
    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-4">
        <div class="relative w-full sm:w-[290px]">
            <input type="text" data-search placeholder="E'lon nomi yoki ID bo'yicha qidirish..."
                   class="w-full bg-white border border-slate-300 rounded-full py-1.5 pl-3.5 pr-9 text-[11px] text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#0077FE]">
            <i class="fa-solid fa-magnifying-glass absolute right-3 top-1/2 -translate-y-1/2 text-[#0077FE] text-xs"></i>
        </div>

        <div class="flex items-center gap-2 sm:ml-auto sm:mr-auto">
            <select data-category class="bg-white border border-slate-300 rounded-full px-3 py-1.5 text-[11px] font-semibold text-slate-700 focus:outline-none cursor-pointer">
                <option value="">Barcha tur</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>

            <label class="relative bg-white border border-slate-300 rounded-full pl-3 pr-2 py-1.5 text-[11px] font-semibold text-slate-700 flex items-center gap-1.5 cursor-pointer">
                <span>Filtrlar</span>
                <i class="fa-solid fa-sliders text-[10px]"></i>
                <select data-sort class="absolute inset-0 opacity-0 cursor-pointer" title="Saralash">
                    <option value="newest">Avval yangilari</option>
                    <option value="oldest">Avval eskilari</option>
                    <option value="price_asc">Narx: arzonidan</option>
                    <option value="price_desc">Narx: qimmatidan</option>
                    <option value="views">Ko'p ko'rilgan</option>
                </select>
            </label>
        </div>
    </div>

    <!-- E'lonlar ro'yxati -->
    <div class="space-y-3 mt-4" data-list>
        @foreach($userProducts as $product)
            @php
                $rowImages = is_array($product->images) ? $product->images : [];
                $rowImage = $rowImages[0] ?? '/images/apartment1.png';
                $rowStatus = $statusOf($product);
            @endphp
            <div class="border border-slate-300 rounded-xl p-3 sm:p-4 hover:shadow-md transition-shadow"
                 data-item
                 data-status="{{ $rowStatus }}"
                 data-category="{{ $product->category->name ?? '' }}"
                 data-search-text="{{ mb_strtolower(($product->name ?? '') . ' ' . (10000 + $product->id) . ' ' . $product->id) }}"
                 data-created="{{ $product->created_at?->timestamp ?? 0 }}"
                 data-price="{{ (float) $product->price }}"
                 data-views="{{ $product->views->count() }}">

                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                    <a href="{{ route('products.show', $product->id) }}" class="relative w-full sm:w-36 h-36 sm:h-24 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0 block">
                        <img src="{{ $rowImage }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @if($product->is_top)
                            <span class="absolute top-1.5 left-1.5 bg-amber-400 text-white font-black text-[9px] px-1.5 py-0.5 rounded flex items-center gap-1">
                                <i class="fa-solid fa-crown text-[9px]"></i> TOP
                            </span>
                        @endif
                    </a>

                    <div class="flex-1 min-w-0 space-y-1">
                        <div class="flex items-center gap-2 flex-wrap text-[10px]">
                            @if($rowStatus === 'active')
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold px-2 py-0.5 rounded">Faol</span>
                            @else
                                <span class="bg-slate-100 text-slate-600 border border-slate-300 font-bold px-2 py-0.5 rounded">{{ $tabs[$rowStatus] }}</span>
                            @endif
                            <span class="text-slate-500 font-semibold">ID {{ 10000 + $product->id }}</span>
                            <span class="text-slate-500 font-semibold"><i class="fa-regular fa-clock"></i> {{ $product->created_at?->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('products.show', $product->id) }}" class="block font-extrabold text-slate-900 text-sm hover:text-[#0077FE] line-clamp-1">
                            {{ $product->name }}
                        </a>

                        <div class="text-[11px] text-slate-500 truncate">
                            <i class="fa-solid fa-location-dot text-slate-400"></i>
                            {{ $product->city->name_uz ?? ($product->region->name_uz ?? ($product->landmark ?? 'Toshkent shahar')) }}
                            &bull; {{ $product->category->name ?? '' }}
                        </div>

                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="font-black text-[#0077FE] text-sm">{{ number_format((float) $product->price, 0, '', ' ') }} so'm</span>
                            <span class="text-[11px] font-semibold text-slate-500"><i class="fa-regular fa-eye text-[#0077FE]"></i> {{ $product->views->count() }} ko'rish</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 sm:flex sm:flex-col gap-1.5 flex-shrink-0">
                        <button type="button" onclick="openTopModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->is_top ? 'true' : 'false' }})"
                                class="{{ $product->is_top ? 'bg-amber-50 border-amber-300 text-amber-700 hover:bg-amber-100' : 'bg-amber-400 border-amber-400 text-white hover:bg-amber-500' }} border font-bold text-[11px] px-3 py-1.5 rounded-lg flex items-center justify-center gap-1.5 cursor-pointer transition-colors">
                            <i class="fa-solid fa-crown text-[10px]"></i> {{ $product->is_top ? 'TOPdan' : 'TOPga' }}
                        </button>
                        <a href="{{ route('client.products.edit', $product->id) }}"
                           class="border border-[#0077FE] text-[#0077FE] hover:bg-blue-50 font-bold text-[11px] px-3 py-1.5 rounded-lg flex items-center justify-center gap-1.5 transition-colors">
                            <i class="fa-regular fa-pen-to-square text-[10px]"></i> Tahrir
                        </a>
                        <button type="button" onclick="openDeleteProductModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                class="border border-red-200 text-red-600 hover:bg-red-50 font-bold text-[11px] px-3 py-1.5 rounded-lg flex items-center justify-center gap-1.5 cursor-pointer transition-colors">
                            <i class="fa-regular fa-trash-can text-[10px]"></i> O'chirish
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bo'sh holat -->
    <div data-empty class="{{ $userProducts->isEmpty() ? '' : 'hidden' }} text-center py-16 sm:py-24">
        <h4 class="font-extrabold text-slate-900 text-sm" data-empty-title>
            {{ $userProducts->isEmpty() ? "Hozir e'lonlaringiz mavjud emas!" : "Mos e'lon topilmadi" }}
        </h4>
        <p class="text-[11px] text-slate-500 mt-1 max-w-[260px] mx-auto" data-empty-text>
            @if($userProducts->isEmpty())
                Siz hali ham e'lon joylashtirmadingiz. E'lon joylash tugmasini bosib birinchi e'loningizni joylashtiring.
            @else
                Qidiruv yoki filtr shartlarini o'zgartirib ko'ring.
            @endif
        </p>
    </div>
</div>

@once
    @push('cabinet-scripts')
        <script>
            document.querySelectorAll('[data-my-products]').forEach(function (root) {
                const limit = parseInt(root.dataset.limit, 10) || 0;
                const list = root.querySelector('[data-list]');
                const items = Array.from(root.querySelectorAll('[data-item]'));
                const empty = root.querySelector('[data-empty]');
                const search = root.querySelector('[data-search]');
                const category = root.querySelector('[data-category]');
                const sort = root.querySelector('[data-sort]');
                const tabs = root.querySelectorAll('.my-products-tab');
                const activeClasses = ['bg-[#0077FE]', 'text-white', 'border-[#0077FE]'];
                const idleClasses = ['bg-white', 'text-slate-700', 'border-slate-300'];
                let status = 'all';

                const sorters = {
                    newest: (a, b) => b.dataset.created - a.dataset.created,
                    oldest: (a, b) => a.dataset.created - b.dataset.created,
                    price_asc: (a, b) => a.dataset.price - b.dataset.price,
                    price_desc: (a, b) => b.dataset.price - a.dataset.price,
                    views: (a, b) => b.dataset.views - a.dataset.views,
                };

                function render() {
                    const term = search.value.trim().toLowerCase();
                    const matched = items
                        .filter(el => status === 'all' || el.dataset.status === status)
                        .filter(el => !category.value || el.dataset.category === category.value)
                        .filter(el => !term || el.dataset.searchText.includes(term))
                        .sort(sorters[sort.value]);

                    items.forEach(el => el.classList.add('hidden'));
                    matched.slice(0, limit || matched.length).forEach(el => {
                        el.classList.remove('hidden');
                        list.appendChild(el);
                    });

                    if (items.length) empty.classList.toggle('hidden', matched.length > 0);
                }

                tabs.forEach(tab => tab.addEventListener('click', function () {
                    status = this.dataset.tab;
                    tabs.forEach(t => {
                        const on = t === this;
                        activeClasses.forEach(c => t.classList.toggle(c, on));
                        idleClasses.forEach(c => t.classList.toggle(c, !on));
                    });
                    render();
                }));
                search.addEventListener('input', render);
                category.addEventListener('change', render);
                sort.addEventListener('change', render);
                render();
            });
        </script>
    @endpush
@endonce
