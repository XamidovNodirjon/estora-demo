@php
    $currentTrans = request('transaction_type', 'Sotuv');
    $currentProp = request('property_type', '');
    $currentRegion = request('region_id', '');
    $currentCity = request('city_id', '');
    $currentTime = request('time_filter', '');
    $currentMetro = request('metro_id', '');
    $currentUni = request('university_id', '');
    $currentProductId = request('product_id', '');
    $activeCountDisplay = isset($totalActiveProductsCount) && $totalActiveProductsCount > 0 ? number_format($totalActiveProductsCount, 0, '', ' ') : (isset($products) && method_exists($products, 'total') ? number_format($products->total(), 0, '', ' ') : '1 213');

    $allPropertyTypes = [
        'Kvartira',
        'Hovli / Uy',
        'Dacha',
        'Yer uchastkasi',
        'Ofis',
        'Do‘kon',
        'Tijorat binosi',
        'Ombor',
        'Ishlab chiqarish binosi',
        'Garaj / Avtoturargoh',
        'Mehmonxona / Hostel',
        'Restoran / Kafe',
        'Bino',
        'Noturar joy'
    ];
@endphp

<!-- GORIZONTAL FILTER CONTAINER (IMAGES 1 & 2) -->
<div class="filter-container">
    <form action="{{ route('maniDashboard') }}" method="GET" id="mainSearchFilterForm">
        <input type="hidden" name="transaction_type" id="hidden_transaction_type" value="{{ $currentTrans }}">

        <!-- Transaction Tabs (Image 1) -->
        <div class="filter-tabs">
            @foreach(['Sotuv', 'Ijara', 'Xonadosh', 'Tijorat', 'Dacha', 'Xalqaro'] as $tab)
                <button type="button" 
                        class="filter-tab {{ $currentTrans == $tab ? 'active' : '' }}" 
                        data-tab-value="{{ $tab }}"
                        onclick="selectSearchTab('{{ $tab }}')">
                    {{ $tab }}
                </button>
            @endforeach
        </div>

        <!-- Filter Box (Images 1 & 2) -->
        <div class="filter-box">
            <!-- Main Filter Row (Mulk turi, Viloyat, Tuman + Actions) -->
            <div class="filter-main-row">
                <div class="filter-fields-grid">
                    <!-- 1. Mulk turi -->
                    <div class="filter-field">
                        <label>Mulk turi</label>
                        <div class="filter-select-wrapper">
                            <select name="property_type" id="search_property_type">
                                <option value="">Tanlang</option>
                                @foreach($allPropertyTypes as $pt)
                                    <option value="{{ $pt }}" {{ $currentProp == $pt ? 'selected' : '' }}>{{ $pt }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <!-- 2. Viloyat -->
                    <div class="filter-field">
                        <label>Viloyat</label>
                        <div class="filter-select-wrapper">
                            <select name="region_id" id="search_region_id" onchange="filterCitiesByRegion()">
                                <option value="">Tanlang</option>
                                @if(isset($regions))
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $currentRegion == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <!-- 3. Tuman -->
                    <div class="filter-field">
                        <label>Tuman</label>
                        <div class="filter-select-wrapper">
                            <select name="city_id" id="search_city_id">
                                <option value="">Tanlang</option>
                                @if(isset($regions))
                                    @foreach($regions as $region)
                                        @foreach($region->cities as $city)
                                            <option value="{{ $city->id }}" data-region="{{ $region->id }}" {{ $currentCity == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div class="filter-actions-group">
                    @php
                        $showAdvanced = !empty($currentMetro) || !empty($currentUni) || !empty($currentTime);
                    @endphp
                    <!-- FILTR Button -->
                    <button type="button" class="btn-filter-settings {{ $showAdvanced ? 'active' : '' }}" id="btnToggleAdvancedFilters" onclick="toggleAdvancedFilters()" title="Qo'shimcha filtrlar">
                        <i class="fas fa-sliders-h"></i>
                        <span>FILTR</span>
                    </button>

                    <!-- QIDIRISH Button -->
                    <button type="submit" class="btn-filter-search">
                        <i class="fas fa-search"></i>
                        <span>QIDIRISH</span>
                    </button>
                </div>
            </div>

            <!-- Advanced Filter Row (Metro, Universitet, So'ngi e'lonlar) - Collapsible -->
            <div class="filter-advanced-row" id="advancedFiltersRow" style="{{ $showAdvanced ? 'display: block;' : 'display: none;' }}">
                <div class="filter-fields-grid">
                    <!-- 4. Metro Bekati -->
                    <div class="filter-field">
                        <label>Metro</label>
                        <div class="filter-select-wrapper">
                            <select name="metro_id" id="search_metro_id">
                                <option value="">Tanlang</option>
                                @if(isset($metros))
                                    @foreach($metros as $metro)
                                        <option value="{{ $metro->id }}" {{ $currentMetro == $metro->id ? 'selected' : '' }}>{{ $metro->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <!-- 5. Universitet / OTM -->
                    <div class="filter-field">
                        <label>Universitet</label>
                        <div class="filter-select-wrapper">
                            <select name="university_id" id="search_university_id">
                                <option value="">Tanlang</option>
                                @if(isset($universities))
                                    @foreach($universities as $uni)
                                        <option value="{{ $uni->id }}" {{ $currentUni == $uni->id ? 'selected' : '' }}>{{ $uni->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <!-- 6. So'ngi e'lonlar -->
                    <div class="filter-field">
                        <label>So'ngi e'lonlar</label>
                        <div class="filter-select-wrapper">
                            <select name="time_filter" id="search_time_filter">
                                <option value="">Tanlang</option>
                                <option value="Bugungi" {{ $currentTime == 'Bugungi' ? 'selected' : '' }}>Bugungi</option>
                                <option value="Haftalik" {{ $currentTime == 'Haftalik' ? 'selected' : '' }}>Haftalik</option>
                                <option value="Oylik" {{ $currentTime == 'Oylik' ? 'selected' : '' }}>Oylik</option>
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Actions Row (Exact Image 2) -->
            <div class="filter-bottom-actions-row">
                <!-- 1. ID orqali qidirish -->
                <button type="button" class="btn-action-id-search" onclick="openSearchByIdModal()">
                    <span>ID orqali qidirish</span>
                </button>

                <!-- 2. Xaritadan ko'rish -->
                <button type="button" class="btn-action-map-view" onclick="openInteractiveMapModal()">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Xaritadan ko'rish</span>
                </button>

                <!-- 3. Ko'rish {count} e'lonlar -->
                <button type="submit" class="btn-action-primary-search">
                    <span>Ko'rish {{ $activeCountDisplay }} e'lonlar</span>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal for Search By ID -->
<div id="searchByIdModal" class="modal-overlay" onclick="handleIdModalBackdrop(event)">
    <div class="modal-content-card" style="max-width: 440px; padding: 28px; text-align: center;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; background: #eff6ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent-blue); font-size: 18px;">
                    <i class="fas fa-hashtag"></i>
                </div>
                <h3 style="font-size: 18px; font-weight: 800; color: var(--primary-navy); margin: 0;">ID orqali qidirish</h3>
            </div>
            <button type="button" class="btn-modal-close" onclick="closeSearchByIdModal()">&times;</button>
        </div>

        <p style="font-size: 13.5px; color: #64748b; margin-bottom: 20px; text-align: left;">
            E'lonning unikal ID raqamini kiriting (masalan: 10523 yoki 7):
        </p>

        <form action="{{ route('maniDashboard') }}" method="GET" style="display: flex; flex-direction: column; gap: 14px;">
            <div class="filter-select-wrapper" style="height: 48px;">
                <input type="number" name="product_id" id="modalInputProductId" placeholder="E'lon ID raqami..." required style="padding-left: 14px; font-size: 15px; font-weight: 700; height: 100%;">
            </div>

            <button type="submit" class="btn-action-primary-search" style="height: 48px; width: 100%; justify-content: center;">
                <i class="fas fa-arrow-right"></i>
                <span>E'longa o'tish</span>
            </button>
        </form>
    </div>
</div>

<script>
function toggleAdvancedFilters() {
    const row = document.getElementById('advancedFiltersRow');
    const btn = document.getElementById('btnToggleAdvancedFilters');
    if (!row || !btn) return;
    
    if (row.style.display === 'none') {
        row.style.display = 'block';
        btn.classList.add('active');
    } else {
        row.style.display = 'none';
        btn.classList.remove('active');
    }
}

function selectSearchTab(tabName) {
    document.getElementById('hidden_transaction_type').value = tabName;
    document.querySelectorAll('.filter-tab').forEach(btn => {
        if (btn.getAttribute('data-tab-value') === tabName) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}

function openSearchByIdModal() {
    const modal = document.getElementById('searchByIdModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            const input = document.getElementById('modalInputProductId');
            if (input) input.focus();
        }, 100);
    }
}

function closeSearchByIdModal() {
    const modal = document.getElementById('searchByIdModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function handleIdModalBackdrop(e) {
    if (e.target.id === 'searchByIdModal') {
        closeSearchByIdModal();
    }
}

function filterCitiesByRegion() {
    const regionSelect = document.getElementById('search_region_id');
    const citySelect = document.getElementById('search_city_id');
    if (!regionSelect || !citySelect) return;
    
    const selectedRegion = regionSelect.value;
    
    Array.from(citySelect.options).forEach((opt, idx) => {
        if (idx === 0) return;
        if (!selectedRegion || opt.getAttribute('data-region') === selectedRegion) {
            opt.style.display = '';
        } else {
            opt.style.display = 'none';
        }
    });

    const currentOpt = citySelect.options[citySelect.selectedIndex];
    if (currentOpt && currentOpt.getAttribute('data-region') && currentOpt.getAttribute('data-region') !== selectedRegion) {
        citySelect.value = '';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    filterCitiesByRegion();
});
</script>
