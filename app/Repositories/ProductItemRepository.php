<?php

namespace App\Repositories;

use App\Models\ProductItem;

class ProductItemRepository
{
    public function getPaginated($limit = 10)
    {
        return ProductItem::whereNull('product_id')->latest()->paginate($limit);
    }

    public function getAll()
    {
        return ProductItem::whereNull('product_id')->get();
    }

    public function findById($id)
    {
        return ProductItem::findOrFail($id);
    }

    public function create(array $data): ProductItem
    {
        return ProductItem::create($data);
    }

    public function update(ProductItem $productItem, array $data): ProductItem
    {
        $productItem->update($data);
        return $productItem;
    }

    public function delete(ProductItem $productItem): bool
    {
        return $productItem->delete();
    }
}
