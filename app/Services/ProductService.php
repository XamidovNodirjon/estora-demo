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
     * Check if a user is allowed to create a new product.
     * Ordinary clients: max 2 products.
     * Maklers & Admins: unlimited.
     */
    public function canUserCreateProduct(?\App\Models\User $user = null): bool
    {
        $user = $user ?? auth()->user();
        if (!$user) {
            return false;
        }

        $roleName = $user->role?->name ?? $user->type;

        if (in_array($roleName, ['makler', 'admin', 'dev', 'manager'])) {
            return true;
        }

        if ($roleName === 'client') {
            $count = Product::where('user_id', $user->id)->count();
            return $count < 2;
        }

        return true;
    }

    /**
     * Store new product and its features.
     */
    public function createProduct(ProductDto $dto): Product
    {
        $user = $dto->user_id ? \App\Models\User::find($dto->user_id) : auth()->user();

        if ($user && !$this->canUserCreateProduct($user)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'limit' => "Oddiy foydalanuvchi (Mijoz) maksimal 2 ta e'lon qo'sha oladi. Cheksiz e'lon joylashtirish uchun Makler hisobi bilan ro'yxatdan o'ting!"
            ]);
        }

        $data = $dto->toArray();
        $data['images'] = $this->processBase64Images($dto->images);
        
        $product = $this->repository->create($data);

        if (!empty($dto->items)) {
            $this->repository->syncItems($product, $dto->items);
        }

        if (!empty($dto->metros)) {
            $this->repository->syncMetros($product, $dto->metros);
        }

        if (!empty($dto->universities)) {
            $this->repository->syncUniversities($product, $dto->universities);
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
        $this->repository->syncMetros($updatedProduct, $dto->metros ?? []);
        $this->repository->syncUniversities($updatedProduct, $dto->universities ?? []);

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
     * Record a product view entry in product_views table.
     */
    public function recordView(Product $product, ?int $userId = null, ?string $ip = null, ?string $userAgent = null): \App\Models\ProductView
    {
        return \App\Models\ProductView::create([
            'product_id' => $product->id,
            'user_id' => $userId ?? auth()->id(),
            'ip_address' => $ip ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
        ]);
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
