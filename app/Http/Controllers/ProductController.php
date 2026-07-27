<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected RecommendationService $recommendationService,
        protected ProductService $productService
    ) {}

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'subCategory', 'region', 'city', 'user', 'items', 'metros', 'universities']);

        // Record product view entry
        $this->productService->recordView($product);

        $viewsCount = $product->views()->count();
        $isOwner = auth()->check() && (auth()->id() === $product->user_id || in_array(auth()->user()->role?->name ?? auth()->user()->type, ['admin', 'dev', 'manager']));

        // Fetch similar products
        $similarPrice = $this->recommendationService->getSimilarPriceProducts($product);
        $similarArea = $this->recommendationService->getSimilarAreaProducts($product);
        $similarLocation = $this->recommendationService->getSimilarLocationProducts($product);

        return view('products.show', compact(
            'product',
            'viewsCount',
            'isOwner',
            'similarPrice',
            'similarArea',
            'similarLocation'
        ));
    }
}
