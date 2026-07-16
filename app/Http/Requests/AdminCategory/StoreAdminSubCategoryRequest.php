<?php

namespace App\Http\Requests\AdminCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminSubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategoriya tanlanishi shart',
            'category_id.exists' => 'Tanlangan kategoriya mavjud emas',
            'name.required' => 'Nomi talab qilinadi',
            'name.unique' => 'Bu sub-kategoriya allaqachon mavjud',
        ];
    }
}
