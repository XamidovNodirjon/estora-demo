<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDto;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Metro;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\Region;
use App\Models\University;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    /**
     * Display a listing of client's own announcements.
     */
    public function index()
    {
        return redirect()->route('client.dashboard');
    }

    /**
     * Show form to create a new announcement for client/makler.
     */
    public function create()
    {
        if (!$this->service->canUserCreateProduct(Auth::user())) {
            return redirect()->route('client.dashboard')
                ->withErrors(['limit' => 'Oddiy foydalanuvchilar (Mijozlar) maksimal 2 ta e\'lon qo\'sha oladi. Cheksiz e\'lon joylashtirish uchun Makler hisobi bilan ro\'yxatdan o\'ting!']);
        }

        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        $defaultItems = ProductItem::whereNull('product_id')->get();
        $metros = Metro::all();
        $universities = University::all();

        return view('client.products.create', compact('categories', 'regions', 'defaultItems', 'metros', 'universities'));
    }

    /**
     * Store new client/makler announcement.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $dto = ProductDto::fromArray($validated);
        $this->service->createProduct($dto);

        return redirect()->route('client.dashboard')
            ->with('success', 'E\'loningiz muvaffaqiyatli joylashtirildi!');
    }

    /**
     * Display single product details & record view count.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'subCategory', 'region', 'city', 'user', 'items', 'metros', 'universities']);
        
        // Record product view
        $this->service->recordView($product);

        $viewsCount = $product->views_count;
        $isOwner = Auth::check() && (Auth::id() === $product->user_id || in_array(Auth::user()->role?->name ?? Auth::user()->type, ['admin', 'dev', 'manager']));

        return view('client.products.show', compact('product', 'viewsCount', 'isOwner'));
    }

    /**
     * Show form to edit announcement.
     */
    public function edit(Product $product)
    {
        if (Auth::id() !== $product->user_id && !in_array(Auth::user()->role?->name ?? Auth::user()->type, ['admin', 'dev'])) {
            abort(403, 'Ushbu e\'lonni tahrirlash huquqingiz yo\'q.');
        }

        $product->load('items');
        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        $defaultItems = ProductItem::whereNull('product_id')->get();
        $selectedItems = $product->items->pluck('name')->toArray();
        $metros = Metro::all();
        $universities = University::all();
        $selectedMetros = $product->metros->pluck('id')->toArray();
        $selectedUniversities = $product->universities->pluck('id')->toArray();

        return view('client.products.edit', compact('product', 'categories', 'regions', 'defaultItems', 'selectedItems', 'metros', 'universities', 'selectedMetros', 'selectedUniversities'));
    }

    /**
     * Update client's announcement.
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (Auth::id() !== $product->user_id && !in_array(Auth::user()->role?->name ?? Auth::user()->type, ['admin', 'dev'])) {
            abort(403, 'Ushbu e\'lonni tahrirlash huquqingiz yo\'q.');
        }

        $validated = $request->validated();
        $validated['user_id'] = $product->user_id;

        $dto = ProductDto::fromArray($validated);
        $this->service->updateProduct($product, $dto);

        return redirect()->route('client.dashboard')
            ->with('success', 'E\'lon muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete client's announcement.
     */
    public function destroy(Product $product)
    {
        if (Auth::id() !== $product->user_id && !in_array(Auth::user()->role?->name ?? Auth::user()->type, ['admin', 'dev'])) {
            abort(403, 'Ushbu e\'lonni o\'chirish huquqingiz yo\'q.');
        }

        $this->service->deleteProduct($product);

        return redirect()->route('client.dashboard')
            ->with('success', 'E\'lon muvaffaqiyatli o\'chirildi!');
    }
}
