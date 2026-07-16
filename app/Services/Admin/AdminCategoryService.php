<?php

namespace App\Services\Admin;

use App\DTOs\CategoryDto;
use App\DTOs\SubCategoryDto;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class AdminCategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected SubCategoryRepository $subCategoryRepository
    ) {}

    public function getCategories(): Collection
    {
        return $this->categoryRepository->getAllWithSubCategories();
    }

    public function getAllCategoriesOnly(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function storeCategory(CategoryDto $dto): Category
    {
        return $this->categoryRepository->create($dto->toArray());
    }

    public function updateCategory(Category $category, CategoryDto $dto): Category
    {
        return $this->categoryRepository->update($category, $dto->toArray());
    }

    public function deleteCategory(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }

    public function storeSubCategory(SubCategoryDto $dto): SubCategory
    {
        return $this->subCategoryRepository->create($dto->toArray());
    }

    public function updateSubCategory(SubCategory $subCategory, SubCategoryDto $dto): SubCategory
    {
        return $this->subCategoryRepository->update($subCategory, $dto->toArray());
    }

    public function deleteSubCategory(SubCategory $subCategory): bool
    {
        return $this->subCategoryRepository->delete($subCategory);
    }
}