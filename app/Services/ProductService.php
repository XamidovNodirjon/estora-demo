<?php

namespace App\Services;

use App\DTOs\ProductDto;
use App\Models\Product;
use App\Repositories\ProductRepository;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
    ) {}

    /**
     * Get paginated products list.
     */
    public function getProducts($limit = 10)
    {
        return $this->repository->getPaginated($limit);
    }

    /**
     * Find product by ID.
     */
    public function getProductById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Store new product and its features.
     */
    public function createProduct(ProductDto $dto): Product
    {
        $data = $dto->toArray();
        $data['images'] = $this->processBase64Images($dto->images);
        
        $product = $this->repository->create($data);

        if (!empty($dto->items)) {
            $this->repository->syncItems($product, $dto->items);
        }

        return $product;
    }

    /**
     * Update product and its features.
     */
    public function updateProduct(Product $product, ProductDto $dto): Product
    {
        $data = $dto->toArray();
        $data['images'] = $this->processBase64Images($dto->images);

        $updatedProduct = $this->repository->update($product, $data);

        $this->repository->syncItems($updatedProduct, $dto->items);

        return $updatedProduct;
    }

    /**
     * Delete product.
     */
    public function deleteProduct(Product $product): bool
    {
        return $this->repository->delete($product);
    }

    /**
     * Decode base64 strings and save as images in public disk.
     */
    protected function processBase64Images(array $images): array
    {
        $processed = [];
        foreach ($images as $img) {
            if (empty($img)) {
                continue;
            }
            if (str_starts_with($img, 'data:image/')) {
                // Decode base64 and save to storage
                $parts = explode(',', $img);
                $decoded = base64_decode($parts[1]);
                
                // Detect extension
                $extension = 'jpg';
                if (preg_match('/^data:image\/(\w+);base64/', $img, $type)) {
                    $extension = strtolower($type[1]);
                }
                
                $fileName = Str::random(40) . '.' . $extension;
                $path = 'products/' . $fileName;
                
                Storage::disk('public')->put($path, $decoded);
                $processed[] = Storage::url($path);
            } else {
                // Already stored image URL, keep it
                $processed[] = $img;
            }
        }
        return $processed;
    }
}
