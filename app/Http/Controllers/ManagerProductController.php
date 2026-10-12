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

class ManagerProductController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    /**
     * Houses of the manager: assigned by admin + created by himself.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $source = in_array($request->query('source'), ['own', 'assigned']) ? $request->query('source') : null;

        $products = $this->service->getManagerProducts($user, 10, $source);
        $assignedCount = $this->service->countAssignedProducts($user);
        $ownCount = $this->service->countOwnProducts($user);

        return view('manager.products.index', compact('products', 'source', 'assignedCount', 'ownCount'));
    }

    public function create()
    {
        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        $defaultItems = ProductItem::whereNull('product_id')->get();
        $metros = Metro::all();
        $universities = University::all();

        return view('admin.products.create', array_merge(
            compact('categories', 'regions', 'defaultItems', 'metros', 'universities'),
            $this->viewContext()
        ));
    }

    public function store(ProductRequest $request)
    {
        $dto = ProductDto::fromArray(array_merge($request->validated(), ['user_id' => Auth::id()]));
        $this->service->createProduct($dto);

        return redirect()->route('manager.products', ['source' => 'own'])
            ->with('success', 'Uy muvaffaqiyatli qo\'shildi!');
    }

    public function edit(Product $product)
    {
        $this->authorizeOwner($product);

        $product->load('items');
        $categories = Category::with('subCategories')->get();
        $regions = Region::with('cities')->get();
        $defaultItems = ProductItem::whereNull('product_id')->get();
        $selectedItems = $product->items->pluck('name')->toArray();
        $metros = Metro::all();
        $universities = University::all();
        $selectedMetros = $product->metros->pluck('id')->toArray();
        $selectedUniversities = $product->universities->pluck('id')->toArray();

        return view('admin.products.edit', array_merge(
            compact('product', 'categories', 'regions', 'defaultItems', 'selectedItems', 'metros', 'universities', 'selectedMetros', 'selectedUniversities'),
            $this->viewContext()
        ));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorizeOwner($product);

        $dto = ProductDto::fromArray(array_merge($request->validated(), ['user_id' => $product->user_id]));
        $this->service->updateProduct($product, $dto);

        return redirect()->route('manager.products', ['source' => 'own'])
            ->with('success', 'Uy muvaffaqiyatli yangilandi!');
    }

    public function destroy(Product $product)
    {
        $this->authorizeOwner($product);

        $this->service->deleteProduct($product);

        return redirect()->route('manager.products', ['source' => 'own'])
            ->with('success', 'Uy o\'chirildi!');
    }

    /**
     * Manager may edit/delete only houses he created; assigned houses are read-only.
     */
    protected function authorizeOwner(Product $product): void
    {
        if ((int) $product->user_id !== (int) Auth::id()) {
            abort(403, 'Siz faqat o\'zingiz qo\'shgan uylarni tahrirlay olasiz.');
        }
    }

    /**
     * Shared product form views are rendered inside the manager layout.
     */
    protected function viewContext(): array
    {
        return [
            'layout' => 'layouts.manager',
            'routePrefix' => 'manager.products',
        ];
    }
}
