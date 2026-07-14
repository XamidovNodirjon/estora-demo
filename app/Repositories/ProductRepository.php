<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductItem;

class ProductRepository
{
    /**
     * Get paginated products with relations.
     */
    public function getPaginated($limit = 10)
    {
        return Product::with(['category', 'subCategory', 'region', 'city', 'user'])
            ->latest()
            ->paginate($limit);
    }

    /**
     * Find a product by ID.
     */
    public function findById($id)
    {
        return Product::with(['category', 'subCategory', 'region', 'city', 'user', 'items'])->findOrFail($id);
    }

    /**
     * Create a new product.
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update an existing product.
     */
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product.
     */
    public function delete(Product $product): bool
    {
        $product->items()->delete();
        return $product->delete();
    }

    /**
     * Sync items associated with a product.
     * Inserts new product_items rows specifically associated with the product.
     */
    public function syncItems(Product $product, array $itemNames): void
    {
        // First, delete old product-specific items
        $product->items()->delete();

        // Create new ones
        foreach ($itemNames as $name) {
            ProductItem::create([
                'name' => $name,
                'product_id' => $product->id,
            ]);
        }
    }
}
