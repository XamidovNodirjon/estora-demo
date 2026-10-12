<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;

class ProductRepository
{
    /**
     * Get paginated products with relations.
     */
    public function getPaginated($limit = 10)
    {
        return Product::with(['category', 'subCategory', 'region', 'city', 'user', 'managers'])
            ->latest()
            ->paginate($limit);
    }

    /**
     * Get products of a manager: created by the manager or assigned to him by admin.
     */
    public function getForManager(User $manager, $limit = 10, ?string $source = null)
    {
        return Product::with(['category', 'subCategory', 'region', 'city', 'user', 'managers'])
            ->where(function ($query) use ($manager, $source) {
                if ($source !== 'assigned') {
                    $query->orWhere('user_id', $manager->id);
                }
                if ($source !== 'own') {
                    $query->orWhereHas('managers', fn ($q) => $q->where('users.id', $manager->id));
                }
            })
            ->latest()
            ->paginate($limit)
            ->withQueryString();
    }

    public function countOwnedBy(User $user): int
    {
        return Product::where('user_id', $user->id)->count();
    }

    public function countAssignedTo(User $manager): int
    {
        return $manager->assignedProducts()->count();
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
        $product->managers()->detach();
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

    public function syncMetros(Product $product, array $metroIds): void
    {
        $product->metros()->sync($metroIds);
    }

    public function syncUniversities(Product $product, array $universityIds): void
    {
        $product->universities()->sync($universityIds);
    }
}
