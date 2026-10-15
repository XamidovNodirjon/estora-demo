<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // "+998 (90) 123-45-67" -> "998901234567"
        $this->merge([
            'phone' => preg_replace('/[^\d]/', '', (string) $this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^(998)?\d{9}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Telefon raqamini kiriting.',
            'phone.regex' => 'Telefon raqam noto\'g\'ri. Masalan: +998 90 123 45 67',
        ];
    }
}
