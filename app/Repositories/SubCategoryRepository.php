<?php

namespace App\Repositories;

use App\Models\SubCategory;

class SubCategoryRepository
{
    public function findById(int $id): SubCategory
    {
        return SubCategory::findOrFail($id);
    }

    public function create(array $data): SubCategory
    {
        return SubCategory::create($data);
    }

    public function update(SubCategory $subCategory, array $data): SubCategory
    {
        $subCategory->update($data);
        return $subCategory;
    }

    public function delete(SubCategory $subCategory): bool
    {
        return $subCategory->delete();
    }
}
