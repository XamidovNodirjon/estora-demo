<?php

namespace App\Services;

use App\Models\Product;

class RecommendationService
{
    /**
     * Get similar products by price range (+/- 20%).
     */
    public function getSimilarPriceProducts(Product $product, $limit = 4)
    {
        $minPrice = $product->price * 0.8;
        $maxPrice = $product->price * 1.2;

        return Product::with(['category', 'subCategory', 'region', 'city', 'items'])
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get similar products by square area range (+/- 20%).
     */
    public function getSimilarAreaProducts(Product $product, $limit = 4)
    {
        $minSquare = $product->square * 0.8;
        $maxSquare = $product->square * 1.2;

        return Product::with(['category', 'subCategory', 'region', 'city', 'items'])
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->whereBetween('square', [$minSquare, $maxSquare])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get similar products by location (same city or same region).
     */
    public function getSimilarLocationProducts(Product $product, $limit = 4)
    {
        return Product::with(['category', 'subCategory', 'region', 'city', 'items'])
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('city_id', $product->city_id)
                      ->orWhere('region_id', $product->region_id);
            })
            ->latest()
            ->limit($limit)
            ->get();
    }
}
