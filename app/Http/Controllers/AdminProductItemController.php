<?php

namespace App\Http\Controllers;

use App\DTOs\ProductItemDto;
use App\Http\Requests\ProductItemRequest;
use App\Models\ProductItem;
use App\Services\ProductItemService;

class AdminProductItemController extends Controller
{
    public function __construct(
        protected ProductItemService $service
    ) {}

    public function store(ProductItemRequest $request)
    {
        $dto = ProductItemDto::fromArray($request->validated());
        $this->service->createProductItem($dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Qo\'shimcha imkoniyat muvaffaqiyatli yaratildi!');
    }

    public function update(ProductItemRequest $request, ProductItem $productItem)
    {
        $dto = ProductItemDto::fromArray($request->validated());
        $this->service->updateProductItem($productItem, $dto);

        return redirect()->route('admin.infrastructure')->with('success', 'Qo\'shimcha imkoniyat muvaffaqiyatli yangilandi!');
    }

    public function destroy(ProductItem $productItem)
    {
        $this->service->deleteProductItem($productItem);
        return redirect()->route('admin.infrastructure')->with('success', 'Qo\'shimcha imkoniyat o\'chirildi!');
    }
}
