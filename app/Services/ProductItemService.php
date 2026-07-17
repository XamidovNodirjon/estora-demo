<?php

namespace App\Services;

use App\DTOs\ProductItemDto;
use App\Models\ProductItem;
use App\Repositories\ProductItemRepository;

class ProductItemService
{
    public function __construct(
        protected ProductItemRepository $repository
    ) {}

    public function getProductItems($limit = 10)
    {
        return $this->repository->getPaginated($limit);
    }

    public function getAllProductItems()
    {
        return $this->repository->getAll();
    }

    public function getProductItemById($id)
    {
        return $this->repository->findById($id);
    }

    public function createProductItem(ProductItemDto $dto): ProductItem
    {
        return $this->repository->create($dto->toArray());
    }

    public function updateProductItem(ProductItem $productItem, ProductItemDto $dto): ProductItem
    {
        return $this->repository->update($productItem, $dto->toArray());
    }

    public function deleteProductItem(ProductItem $productItem): bool
    {
        return $this->repository->delete($productItem);
    }
}
