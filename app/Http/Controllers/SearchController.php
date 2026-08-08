<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Region;
use App\Models\Category;
use App\Models\SubCategory;
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

        // 1. Filter by Transaction Type (Category, e.g. Sotuv, Ijara, Xonadosh...)
        if ($request->filled('transaction_type') && !in_array($request->input('transaction_type'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $transactionType = trim($request->input('transaction_type'));
            $query->where(function ($q) use ($transactionType) {
                if (is_numeric($transactionType)) {
                    $q->where('category_id', $transactionType);
                } else {
                    $q->whereHas('category', function ($catQ) use ($transactionType) {
                        $catQ->where('name', 'like', "%{$transactionType}%");
                    });
                }
            });
        }

        // 2. Filter by Property Type (SubCategory, e.g. Kvartira, Hovli, Ofis, Do'kon...)
        if ($request->filled('property_type') && !in_array($request->input('property_type'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $propertyType = trim($request->input('property_type'));
            $query->where(function ($q) use ($propertyType) {
                if (is_numeric($propertyType)) {
                    $q->where('subcategory_id', $propertyType);
                } else {
                    $q->whereHas('subCategory', function ($subQ) use ($propertyType) {
                        $subQ->where('name', 'like', "%{$propertyType}%");
                    });
                }
            });
        }

        // 3. Filter by Region
        if ($request->filled('region_id') && !in_array($request->input('region_id'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $query->where('region_id', $request->input('region_id'));
        }

        // 4. Filter by City (Tuman)
        if ($request->filled('city_id') && !in_array($request->input('city_id'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $query->where('city_id', $request->input('city_id'));
        }

        // 5. Filter by Time (So'ngi e'lonlar)
        if ($request->filled('time_filter') && !in_array($request->input('time_filter'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $timeFilter = $request->input('time_filter');
            if ($timeFilter === 'Bugungi') {
                $query->whereDate('created_at', Carbon::today());
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
        $products = $query->paginate(12)->withQueryString();

        // Get regions with cities for dynamic cascading select
        $regions = Region::with('cities')->get();

        // Get categories (excluding internal admin role names)
        $categories = Category::whereNotIn('name', ['admin'])->get();

        // Get clean list of available property types from SubCategory
        $propertyTypes = SubCategory::whereNotIn('name', ['nimadir', 'sadjasd', 'test 1 sub', '322'])
            ->select('name')
            ->distinct()
            ->pluck('name');

        return view('maniDashboard', compact('products', 'regions', 'categories', 'propertyTypes'));
    }
}
