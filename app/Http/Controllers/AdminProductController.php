<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDto;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Region;
use App\Services\ProductService;

class AdminProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    /**
     * Display a listing of all announcements.
     */
    public function index()
    {
        $products = $this->service->getProducts(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show form to create a new announcement.
     */
    public function create()
    {
        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        // Load default product items templates (product_id is null)
        $defaultItems = ProductItem::whereNull('product_id')->get();
        $metros = \App\Models\Metro::all();
        $universities = \App\Models\University::all();

        return view('admin.products.create', compact('categories', 'regions', 'defaultItems', 'metros', 'universities'));
    }

    /**
     * Store new announcement.
     */
    public function store(ProductRequest $request)
    {
        $dto = ProductDto::fromArray($request->validated());
        $this->service->createProduct($dto);

        return redirect()->route('admin.products')
            ->with('success', 'E\'lon muvaffaqiyatli yaratildi!');
    }

    /**
     * Show form to edit announcement.
     */
    public function edit(Product $product)
    {
        $product->load('items');
        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        
        // Load default product items templates (product_id is null)
        $defaultItems = ProductItem::whereNull('product_id')->get();
        
        // Get names of checked items
        $selectedItems = $product->items->pluck('name')->toArray();
        $metros = \App\Models\Metro::all();
        $universities = \App\Models\University::all();
        $selectedMetros = $product->metros->pluck('id')->toArray();
        $selectedUniversities = $product->universities->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'regions', 'defaultItems', 'selectedItems', 'metros', 'universities', 'selectedMetros', 'selectedUniversities'));
    }

    /**
     * Update the announcement.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $dto = ProductDto::fromArray($request->validated());
        $this->service->updateProduct($product, $dto);

        return redirect()->route('admin.products')
            ->with('success', 'E\'lon muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the announcement.
     */
    public function destroy(Product $product)
    {
        $this->service->deleteProduct($product);

        return redirect()->route('admin.products')
            ->with('success', 'E\'lon muvaffaqiyatli o\'chirildi!');
    }
}
