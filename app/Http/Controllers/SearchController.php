<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Region;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Metro;
use App\Models\University;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display a listing of filtered products.
     */
    public function maniDashboard(Request $request)
    {
        $query = Product::with(['category', 'subCategory', 'region', 'city', 'items', 'metros', 'universities'])
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

        // 5. Filter by Metro Station
        if ($request->filled('metro_id') && !in_array($request->input('metro_id'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $metroId = $request->input('metro_id');
            $query->whereHas('metros', function ($q) use ($metroId) {
                if (is_numeric($metroId)) {
                    $q->where('metros.id', $metroId);
                } else {
                    $q->where('metros.name', 'like', "%{$metroId}%");
                }
            });
        }

        // 6. Filter by University
        if ($request->filled('university_id') && !in_array($request->input('university_id'), ['Tanlang', 'Barchasi', 'all', ''])) {
            $uniId = $request->input('university_id');
            $query->whereHas('universities', function ($q) use ($uniId) {
                if (is_numeric($uniId)) {
                    $q->where('universities.id', $uniId);
                } else {
                    $q->where('universities.name', 'like', "%{$uniId}%");
                }
            });
        }

        // 7. Filter by Time (So'ngi e'lonlar)
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

        // 8. Filter by Product ID (e.g. 10523 or direct id)
        if ($request->filled('product_id')) {
            $rawId = (int)$request->input('product_id');
            $actualId = $rawId > 10000 ? ($rawId - 10000) : $rawId;
            $query->where(function($q) use ($rawId, $actualId) {
                $q->where('id', $rawId)->orWhere('id', $actualId);
            });
        }

        // 9. Sorting (Always prioritize TOP announcements first!)
        $query->orderBy('is_top', 'desc');

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

        // Total active count for CTA badge
        $totalActiveProductsCount = Product::where('status', 'active')->count();

        // Get regions with cities for dynamic cascading select
        $regions = Region::with('cities')->get();

        // Get metros & universities
        $metros = Metro::orderBy('name')->get();
        $universities = University::orderBy('name')->get();

        // Get categories (excluding internal admin role names)
        $categories = Category::whereNotIn('name', ['admin'])->get();

        // Get clean list of available property types from SubCategory
        $propertyTypes = SubCategory::whereNotIn('name', ['nimadir', 'sadjasd', 'test 1 sub', '322'])
            ->select('name')
            ->distinct()
            ->pluck('name');

        // Prepare map markers data
        $mapProducts = Product::with(['category', 'subCategory', 'region', 'city'])
            ->where('status', 'active')
            ->get()
            ->map(function ($product) {
                // Default coordinates around Tashkent/Uzbekistan if empty
                $lat = $product->latitude ?: (41.2995 + (crc32($product->id . 'lat') % 1000) / 10000);
                $lng = $product->longitude ?: (69.2401 + (crc32($product->id . 'lng') % 1000) / 10000);
                
                $images = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
                $firstImg = !empty($images) ? $images[0] : '/images/hero.png';
                if (!str_starts_with($firstImg, 'http') && !str_starts_with($firstImg, '/')) {
                    $firstImg = '/storage/' . $firstImg;
                }

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => number_format($product->price) . ' USD',
                    'lat' => (float)$lat,
                    'lng' => (float)$lng,
                    'category' => $product->category->name ?? 'Sotuv',
                    'sub_category' => $product->subCategory->name ?? 'Kvartira',
                    'region' => $product->region->name ?? 'Toshkent shahar',
                    'city' => $product->city->name ?? 'Yashnobod tumani',
                    'image' => $firstImg,
                    'url' => route('products.show', $product->id),
                ];
            });

        return view('maniDashboard', compact('products', 'regions', 'categories', 'propertyTypes', 'mapProducts', 'metros', 'universities', 'totalActiveProductsCount'));
    }
}
