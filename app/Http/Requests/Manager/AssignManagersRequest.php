<?php

namespace App\Http\Requests\Manager;

use App\Repositories\ManagerAssignmentRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignManagersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'manager_ids' => ['nullable', 'array'],
            'manager_ids.*' => [
                'integer',
                Rule::in(app(ManagerAssignmentRepository::class)->getManagers()->pluck('id')->all()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'manager_ids.*.in' => 'Tanlangan menejerlardan biri topilmadi.',
        ];
    }
}
