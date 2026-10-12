<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager\AssignManagersRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductAssignmentController extends Controller
{
    public function __construct(
        protected ProductService $service
    ) {}

    /**
     * Assign a product (house) to managers.
     */
    public function update(AssignManagersRequest $request, Product $product)
    {
        $this->service->assignManagers($product, $request->validated('manager_ids') ?? []);

        return redirect()->back()->with('success', 'Uy menejerlarga muvaffaqiyatli biriktirildi!');
    }
}
