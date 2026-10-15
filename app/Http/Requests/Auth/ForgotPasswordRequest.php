<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Parolni tiklash kodi so'rash: username yoki telefon raqam orqali.
 */
class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => trim((string) $this->username),
            // "+998 (90) 123-45-67" -> "998901234567"
            'phone' => preg_replace('/[^\d]/', '', (string) $this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'method' => ['required', 'in:username,phone'],
            'username' => ['required_if:method,username', 'nullable', 'string', 'max:255'],
            'phone' => ['required_if:method,phone', 'nullable', 'string', 'regex:/^(998)?\d{9}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'method.*' => "Tiklash usulini tanlang.",
            'username.required_if' => 'Username kiriting.',
            'phone.required_if' => 'Telefon raqamini kiriting.',
            'phone.regex' => 'Telefon raqam noto\'g\'ri. Masalan: +998 90 123 45 67',
        ];
    }
}
