<?php

namespace App\Http\Requests\Lead;

use App\Enums\LeadStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeLeadStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('changeStatus', $this->route('lead')) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'comment' => is_string($this->comment) ? trim($this->comment) : $this->comment,
        ]);
    }

    public function rules(): array
    {
        $current = $this->route('lead')->status;

        return [
            'status' => ['required', Rule::enum(LeadStatus::class), Rule::notIn([$current->value])],
            'comment' => ['required', 'string', 'min:' . $this->targetStatus()->commentMinLength(), 'max:2000'],
        ];
    }

    public function messages(): array
    {
        $isRejected = $this->targetStatus() === LeadStatus::Rejected;

        return [
            'status.required' => 'Statusni tanlang.',
            'status.enum' => 'Noto\'g\'ri status tanlandi.',
            'status.not_in' => 'Lid allaqachon shu statusda.',
            'comment.required' => $isRejected
                ? 'Rad etilish sababini yozish majburiy.'
                : 'Status o\'zgartirilganda izoh yozish majburiy.',
            'comment.min' => $isRejected
                ? 'Rad etilish sababini aniqroq yozing (kamida :min ta belgi).'
                : 'Izoh kamida :min ta belgidan iborat bo\'lishi kerak.',
            'comment.max' => 'Izoh :max ta belgidan oshmasligi kerak.',
        ];
    }

    protected function targetStatus(): LeadStatus
    {
        return LeadStatus::tryFrom((string) $this->input('status')) ?? LeadStatus::InProgress;
    }
}
