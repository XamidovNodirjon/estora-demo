@extends('layouts.public')

@section('title', "E'lonlar qidiruvi - Estora Real Estate")

@section('styles')
<style>
/* Listings Page Header & Breadcrumb */
.listings-top-bar {
    padding: 18px 0 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-muted);
}
.breadcrumbs a {
    color: var(--primary-navy);
}
.breadcrumbs a:hover {
    color: var(--accent-blue);
}
.breadcrumbs-sep {
    color: #cbd5e1;
    font-size: 11px;
}

/* Control Bar (Sort, View Toggles, Clear) */
.listings-control-bar {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 12px 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}
.results-count-text {
    font-size: 14px;
    font-weight: 700;
    color: var(--primary-navy);
}
.results-count-text span {
    color: var(--accent-blue);
}
.sort-selector-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #475569;
}
.sort-selector-wrap select {
    height: 38px;
    padding: 0 14px;
    border: 1.5px solid var(--border-color);
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-navy);
    background: #f8fafc;
    outline: none;
    cursor: pointer;
}
.sort-selector-wrap select:focus {
    border-color: var(--accent-blue);
}

/* Pagination container */
.pagination-wrapper {
    margin-top: 36px;
    display: flex;
    justify-content: center;
}
.pagination-wrapper nav {
    display: flex;
    gap: 6px;
}
</style>
@endsection

@section('content')
<div class="container" style="padding-top: 10px; padding-bottom: 50px;">
    <!-- Breadcrumb -->
    <div class="listings-top-bar">
        <div class="breadcrumbs">
            <a href="{{ url('/') }}">Bosh sahifa</a>
            <span class="breadcrumbs-sep">/</span>
            <a href="{{ route('maniDashboard', ['transaction_type' => request('transaction_type', 'Sotuv')]) }}">
                {{ request('transaction_type', 'Sotuv') }}
            </a>
            @if(request('property_type') && request('property_type') !== 'Tanlang')
                <span class="breadcrumbs-sep">/</span>
                <span>{{ request('property_type') }}</span>
            @endif
            @if(request('metro_id'))
                <span class="breadcrumbs-sep">/</span>
                <span><i class="fas fa-subway" style="color: var(--accent-blue);"></i> Metro</span>
            @endif
            @if(request('university_id'))
                <span class="breadcrumbs-sep">/</span>
                <span><i class="fas fa-graduation-cap" style="color: var(--accent-blue);"></i> OTM</span>
            @endif
        </div>
    </div>

    <!-- SHARED SEARCH FILTER (TABS + REGION + CITY + METRO + UNIVERSITY + TIME) -->
    <div style="margin-bottom: 25px;">
        @include('partials.search-filter')
    </div>

    <!-- Controls & Results Summary Bar -->
    <div class="listings-control-bar">
        <div class="results-count-text">
            Jami e'lonlar: <span>{{ $products->total() }}</span> ta topildi
        </div>

        <form action="{{ route('maniDashboard') }}" method="GET" id="sortForm" class="sort-selector-wrap">
            @foreach(request()->except('sort_by', 'page') as $k => $v)
                @if(is_array($v))
                    @foreach($v as $arrV)
                        <input type="hidden" name="{{ $k }}[]" value="{{ $arrV }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endif
            @endforeach

            <label for="sort_by">Saralash turi:</label>
            <select name="sort_by" id="sort_by" onchange="document.getElementById('sortForm').submit()">
                <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Eng yangi e'lonlar</option>
                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Narx: Arzonroqdan</option>
                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Narx: Qimmatroqdan</option>
            </select>
        </form>
    </div>

    <!-- Product Announcements Listings (Clean Horizontal Row Cards) -->
    <div class="listings-feed">
        @forelse($products as $product)
            @include('partials.product-row-card', ['product' => $product])
        @empty
            <div style="text-align: center; padding: 60px 20px; background: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; margin: 20px 0;">
                <i class="far fa-folder-open" style="font-size: 54px; color: #94a3b8; margin-bottom: 16px; display: block;"></i>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--primary-navy); margin-bottom: 8px;">
                    Siz tanlagan parametrlar bo'yicha e'lonlar topilmadi
                </h3>
                <p style="font-size: 14px; color: var(--text-muted); max-width: 500px; margin: 0 auto 24px auto;">
                    Iltimos, viloyat, tuman, metro yoki boshqa filtrlarni o'zgartirib qaytadan qidirib ko'ring.
                </p>
                <a href="{{ route('maniDashboard') }}" class="btn-action-primary-search" style="display: inline-flex; text-decoration: none;">
                    <i class="fas fa-undo"></i>
                    <span>Barcha e'lonlarni ko'rish</span>
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
