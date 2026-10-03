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
     * Calculate user profile verification status and percentage.
     */
    public function getVerificationStatus(?\App\Models\User $user = null): array
    {
        $user = $user ?? auth()->user();
        if (!$user) {
            return [
                'percentage' => 0,
                'email_verified' => false,
                'passport_filled' => false,
                'jshshir_filled' => false,
                'phone_filled' => false,
                'can_create_ad' => false,
                'missing_fields' => ['email', 'passport', 'jshshir', 'phone']
            ];
        }

        $emailVerified = !empty($user->email_verified_at);
        $passportFilled = !empty($user->passport) && strlen(trim($user->passport)) >= 7;
        $jshshirFilled = !empty($user->jshshir) && strlen(trim($user->jshshir)) === 14;
        $phoneFilled = !empty($user->phone);

        $percentage = 0;
        $missing = [];

        if ($emailVerified) {
            $percentage += 35;
        } else {
            $missing[] = 'Elektron pochta tasdiqlanmagan';
        }

        if ($passportFilled) {
            $percentage += 25;
        } else {
            $missing[] = 'Pasport seriya va raqami kiritilmagan';
        }

        if ($jshshirFilled) {
            $percentage += 25;
        } else {
            $missing[] = '14 xonali JShShIR kiritilmagan';
        }

        if ($phoneFilled) {
            $percentage += 15;
        } else {
            $missing[] = 'Telefon raqam kiritilmagan';
        }

        $canCreateAd = $emailVerified && $passportFilled && $jshshirFilled;

        return [
            'percentage' => $percentage,
            'email_verified' => $emailVerified,
            'passport_filled' => $passportFilled,
            'jshshir_filled' => $jshshirFilled,
            'phone_filled' => $phoneFilled,
            'can_create_ad' => $canCreateAd,
            'missing_fields' => $missing
        ];
    }

    /**
     * Check if a user is allowed to create a new product.
     * Requires email verification, passport and 14-digit JSHSHIR.
     * Ordinary clients: max 2 products.
     * Maklers & Owners: unlimited.
     */
    public function canUserCreateProduct(?\App\Models\User $user = null): bool
    {
        $user = $user ?? auth()->user();
        if (!$user) {
            return false;
        }

        $roleName = $user->role?->name ?? $user->type;

        // Dev/Admin bypass
        if (in_array($roleName, ['admin', 'dev'])) {
            return true;
        }

        // Email, Passport & JSHSHIR verification check
        $status = $this->getVerificationStatus($user);
        if (!$status['can_create_ad']) {
            return false;
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
