<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display a listing of filtered products.
     */
    public function maniDashboard(Request $request)
    {
        $query = Product::with(['category', 'subCategory', 'region', 'city', 'items'])
            ->where('status', 'active');

        // 1. Filter by Transaction Type (Category name, e.g. Sotuv, Ijara)
        if ($request->filled('transaction_type') && !in_array($request->input('transaction_type'), ['Tanlang', 'Barchasi'])) {
            $transactionType = $request->input('transaction_type');
            $query->whereHas('category', function ($q) use ($transactionType) {
                $q->where('name', 'like', $transactionType);
            });
        }

        // 2. Filter by Property Type (SubCategory name, e.g. Kvartira, Hovli)
        if ($request->filled('property_type') && $request->input('property_type') !== 'Tanlang') {
            $propertyType = $request->input('property_type');
            $query->whereHas('subCategory', function ($q) use ($propertyType) {
                $q->where('name', 'like', $propertyType);
            });
        }

        // 3. Filter by Region
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->input('region_id'));
        }

        // 4. Filter by City
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
        }

        // 5. Filter by Time (So'ngi e'lonlar)
        if ($request->filled('time_filter') && $request->input('time_filter') !== 'Tanlang') {
            $timeFilter = $request->input('time_filter');
            if ($timeFilter === 'Bugungi') {
                $query->where('created_at', '>=', Carbon::today());
            } elseif ($timeFilter === 'Haftalik') {
                $query->where('created_at', '>=', Carbon::now()->subDays(7));
            } elseif ($timeFilter === 'Oylik') {
                $query->where('created_at', '>=', Carbon::now()->subDays(30));
            }
        }

        // 6. Sorting
        $sortBy = $request->input('sort_by', 'newest');
        if ($sortBy === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Paginate results
        $products = $query->paginate(10)->withQueryString();

        // Get regions for the filter form in search view
        $regions = Region::with('cities')->get();

        return view('maniDashboard', compact('products', 'regions'));
    }
}
