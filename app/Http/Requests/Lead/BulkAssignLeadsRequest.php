<?php

namespace App\Http\Requests\Lead;

use App\Repositories\ManagerAssignmentRepository;
use App\Services\LeadService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkAssignLeadsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'lead_ids' => ['required', 'array', 'min:1', 'max:' . LeadService::BULK_ASSIGN_LIMIT],
            'lead_ids.*' => ['integer', 'distinct', 'exists:leads,id'],
            'manager_id' => [
                'required',
                'integer',
                Rule::in(app(ManagerAssignmentRepository::class)->getManagers()->pluck('id')->all()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'lead_ids.required' => 'Kamida bitta lidni tanlang.',
            'lead_ids.min' => 'Kamida bitta lidni tanlang.',
            'lead_ids.max' => 'Bir vaqtning o\'zida ko\'pi bilan :max ta lidni biriktirish mumkin.',
            'lead_ids.*.exists' => 'Tanlangan lidlardan biri topilmadi.',
            'manager_id.required' => 'Menejerni tanlang.',
            'manager_id.in' => 'Tanlangan menejer topilmadi.',
        ];
    }
}
