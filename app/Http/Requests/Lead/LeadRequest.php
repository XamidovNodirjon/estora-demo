<?php

namespace App\Http\Requests\Lead;

use App\Repositories\ManagerAssignmentRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'description' => ['nullable', 'string', 'max:5000'],
            'manager_id' => [
                'nullable',
                'integer',
                Rule::in(app(ManagerAssignmentRepository::class)->getManagers()->pluck('id')->all()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Lid ismini kiritish majburiy.',
            'name.max' => 'Ism 255 ta belgidan oshmasligi kerak.',
            'phone.required' => 'Telefon raqamini kiritish majburiy.',
            'phone.max' => 'Telefon raqami 30 ta belgidan oshmasligi kerak.',
            'description.max' => 'Tavsif 5000 ta belgidan oshmasligi kerak.',
            'manager_id.in' => 'Tanlangan menejer topilmadi.',
        ];
    }
}
