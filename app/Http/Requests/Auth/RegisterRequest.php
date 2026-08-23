<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users|alpha_dash',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'passport' => ['nullable', 'string', 'regex:/^[A-Za-z]{2}[0-9]{7}$/'],
            'jshshir' => ['nullable', 'string', 'regex:/^[0-9]{14}$/'],
            'role' => 'nullable|string|in:client,makler',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('passport') && $this->passport) {
            $this->merge([
                'passport' => strtoupper(trim($this->passport)),
            ]);
        }
        if ($this->has('jshshir') && $this->jshshir) {
            $this->merge([
                'jshshir' => trim($this->jshshir),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ism kiritilishi shart',
            'email.required' => 'Email kiritilishi shart',
            'email.unique' => 'Bu email allaqachon ro\'yxatdan o\'tgan',
            'username.required' => 'Username kiritilishi shart',
            'username.unique' => 'Bu username allaqachon band qilingan',
            'phone.required' => 'Telefon raqam kiritilishi shart',
            'phone.unique' => 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan',
            'password.required' => 'Parol kiritilishi shart',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi shart',
            'password.confirmed' => 'Parollar mos kelmadi',
            'passport.regex' => 'Pasport seriyasi 2 ta harf va 7 ta raqamdan iborat bo\'lishi kerak (masalan: AA1234567)',
            'jshshir.regex' => 'JSHSHIR 14 ta raqamdan iborat bo\'lishi kerak',
        ];
    }
}
