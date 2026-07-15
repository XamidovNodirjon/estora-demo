<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'region_id' => 'required|exists:regions,id',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|string|max:30',
            'floor' => 'nullable|integer|min:0',
            'building_floor' => 'nullable|integer|min:0',
            'square' => 'required|integer|min:0',
            'rooms' => 'required|integer|min:0',
            'repair' => 'nullable|string|max:100',
            'sotix' => 'nullable|integer|min:0',
            'landmark' => 'nullable|string|max:255',
            'exchange' => 'nullable|boolean',
            'pay_in_installments' => 'nullable|boolean',
            'credit' => 'nullable|boolean',
            'items' => 'nullable|array',
            'items.*' => 'string|max:255',
            'metros' => 'nullable|array',
            'metros.*' => 'exists:metros,id',
            'universities' => 'nullable|array',
            'universities.*' => 'exists:universities,id',
            'images' => 'nullable|array',
            'images.*' => 'string',
        ];
    }
}
