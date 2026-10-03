<?php

namespace App\Http\Controllers;

use App\DTOs\CategoryDto;
use App\DTOs\SubCategoryDto;
use App\Http\Requests\AdminCategory\StoreAdminCategoryRequest;
use App\Http\Requests\AdminCategory\UpdateAdminCategoryRequest;
use App\Http\Requests\AdminCategory\StoreAdminSubCategoryRequest;
use App\Http\Requests\AdminCategory\UpdateAdminSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\Admin\AdminCategoryService;

class AdminCategoryController extends Controller
{
    public function __construct(
        protected AdminCategoryService $adminCategoryService
    ) {}

    public function index()
    {
        $categories = $this->adminCategoryService->getCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(StoreAdminCategoryRequest $request)
    {
        $dto = CategoryDto::fromArray($request->validated());
        $this->adminCategoryService->storeCategory($dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya muvaffaqiyatli yaratildi!');
    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(UpdateAdminCategoryRequest $request, Category $category)
    {
        $dto = CategoryDto::fromArray($request->validated());
        $this->adminCategoryService->updateCategory($category, $dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya muvaffaqiyatli yangilandi!');
    }

    public function deleteCategory(Category $category)
    {
        $this->adminCategoryService->deleteCategory($category);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya va uning barcha sub-kategoriyalari o\'chirildi!');
    }

    public function storeSubCategory(StoreAdminSubCategoryRequest $request)
    {
        $dto = SubCategoryDto::fromArray($request->validated());
        $this->adminCategoryService->storeSubCategory($dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yaratildi!');
    }

    public function editSubCategory(SubCategory $subCategory)
    {
        $categories = $this->adminCategoryService->getAllCategoriesOnly();
        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }

    public function updateSubCategory(UpdateAdminSubCategoryRequest $request, SubCategory $subCategory)
    {
        $dto = SubCategoryDto::fromArray($request->validated());
        $this->adminCategoryService->updateSubCategory($subCategory, $dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yangilandi!');
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        $this->adminCategoryService->deleteSubCategory($subCategory);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli o\'chirildi!');
    }
}
