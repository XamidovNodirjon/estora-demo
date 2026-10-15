<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Kod tasdiqlangandan keyin yangi parol (va xohlasa yangi username) o'rnatish.
 */
class ResetPasswordRequest extends FormRequest
{
    public ?User $resetUser = null;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Kod tasdiqlanmagan yoki muddati o'tgan bo'lsa - validatsiyadan oldin to'xtatamiz
        $this->resetUser = app(PasswordResetService::class)->verifiedUser();

        $this->merge([
            'username' => ltrim(trim((string) $this->username), '@'),
        ]);
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z0-9_.\-]+$/',
                Rule::unique('users', 'username')->ignore($this->resetUser?->id),
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username kiriting.',
            'username.min' => 'Username kamida 3 ta belgidan iborat bo\'lishi kerak.',
            'username.max' => 'Username 50 ta belgidan oshmasligi kerak.',
            'username.regex' => 'Username faqat lotin harflari, raqamlar va _ . - belgilaridan iborat bo\'lishi kerak.',
            'username.unique' => 'Bu username band. Boshqasini tanlang.',
            'password.required' => 'Yangi parolni kiriting.',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parollar mos kelmadi.',
        ];
    }
}
