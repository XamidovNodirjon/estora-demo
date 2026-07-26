<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected RecommendationService $recommendationService
    ) {}

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'subCategory', 'region', 'city', 'user', 'items', 'metros', 'universities']);

        // Fetch similar products
        $similarPrice = $this->recommendationService->getSimilarPriceProducts($product);
        $similarArea = $this->recommendationService->getSimilarAreaProducts($product);
        $similarLocation = $this->recommendationService->getSimilarLocationProducts($product);

        return view('products.show', compact(
            'product',
            'similarPrice',
            'similarArea',
            'similarLocation'
        ));
    }
}
