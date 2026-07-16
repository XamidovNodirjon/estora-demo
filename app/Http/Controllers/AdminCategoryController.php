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

    /**
     * Display a listing of categories and subcategories.
     */
    public function index()
    {
        $categories = $this->adminCategoryService->getCategories();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function storeCategory(StoreAdminCategoryRequest $request)
    {
        $dto = CategoryDto::fromArray($request->validated());
        $this->adminCategoryService->storeCategory($dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya muvaffaqiyatli yaratildi!');
    }

    /**
     * Show the form for editing the category.
     */
    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the category.
     */
    public function updateCategory(UpdateAdminCategoryRequest $request, Category $category)
    {
        $dto = CategoryDto::fromArray($request->validated());
        $this->adminCategoryService->updateCategory($category, $dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the category.
     */
    public function deleteCategory(Category $category)
    {
        $this->adminCategoryService->deleteCategory($category);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya va uning barcha sub-kategoriyalari o\'chirildi!');
    }

    /**
     * Store a newly created subcategory.
     */
    public function storeSubCategory(StoreAdminSubCategoryRequest $request)
    {
        $dto = SubCategoryDto::fromArray($request->validated());
        $this->adminCategoryService->storeSubCategory($dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yaratildi!');
    }

    /**
     * Show the form for editing the subcategory.
     */
    public function editSubCategory(SubCategory $subCategory)
    {
        $categories = $this->adminCategoryService->getAllCategoriesOnly();
        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the subcategory.
     */
    public function updateSubCategory(UpdateAdminSubCategoryRequest $request, SubCategory $subCategory)
    {
        $dto = SubCategoryDto::fromArray($request->validated());
        $this->adminCategoryService->updateSubCategory($subCategory, $dto);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the subcategory.
     */
    public function deleteSubCategory(SubCategory $subCategory)
    {
        $this->adminCategoryService->deleteSubCategory($subCategory);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli o\'chirildi!');
    }
}
