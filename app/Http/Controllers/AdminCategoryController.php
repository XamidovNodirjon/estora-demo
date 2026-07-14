<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of categories and subcategories.
     */
    public function index()
    {
        $categories = Category::with('subCategories')->withCount('subCategories')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($data);

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
    public function updateCategory(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($data);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the category.
     */
    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Kategoriya va uning barcha sub-kategoriyalari o\'chirildi!');
    }

    /**
     * Store a newly created subcategory.
     */
    public function storeSubCategory(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name',
        ]);

        SubCategory::create($data);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yaratildi!');
    }

    /**
     * Show the form for editing the subcategory.
     */
    public function editSubCategory(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the subcategory.
     */
    public function updateSubCategory(Request $request, SubCategory $subCategory)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name,' . $subCategory->id,
        ]);

        $subCategory->update($data);

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the subcategory.
     */
    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Sub-kategoriya muvaffaqiyatli o\'chirildi!');
    }
}
