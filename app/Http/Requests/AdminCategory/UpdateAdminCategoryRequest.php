<?php

namespace App\Http\Requests\AdminCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id ?? $this->route('category');
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $categoryId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nomi talab qilinadi',
            'name.unique' => 'Bu kategoriya allaqachon mavjud',
        ];
    }
}
