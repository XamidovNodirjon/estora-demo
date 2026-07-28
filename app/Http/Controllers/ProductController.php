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

        // Fetch seller's other products
        $sellerOtherProducts = Product::where('user_id', $product->user_id)
            ->where('id', '!=', $product->id)
            ->with(['region', 'city', 'category', 'subCategory', 'metros', 'universities'])
            ->latest()
            ->take(4)
            ->get();
        $sellerTotalProductsCount = Product::where('user_id', $product->user_id)->count();

        // Fetch similar products
        $similarPrice = $this->recommendationService->getSimilarPriceProducts($product);
        $similarArea = $this->recommendationService->getSimilarAreaProducts($product);
        $similarLocation = $this->recommendationService->getSimilarLocationProducts($product);

        return view('products.show', compact(
            'product',
            'viewsCount',
            'isOwner',
            'sellerOtherProducts',
            'sellerTotalProductsCount',
            'similarPrice',
            'similarArea',
            'similarLocation'
        ));
    }
}
