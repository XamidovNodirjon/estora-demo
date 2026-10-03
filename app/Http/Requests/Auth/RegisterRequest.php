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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
            'role' => 'nullable|string|in:client,owner,makler,hotel,builder',
        ];
    }

    protected function prepareForValidation(): void
    {
        $merges = [];
        if ($this->has('first_name')) {
            $merges['first_name'] = trim($this->first_name);
        }
        if ($this->has('last_name')) {
            $merges['last_name'] = trim($this->last_name);
        }
        if ($this->has('passport') && $this->passport) {
            $merges['passport'] = strtoupper(trim($this->passport));
        }
        if ($this->has('jshshir') && $this->jshshir) {
            $merges['jshshir'] = trim($this->jshshir);
        }
        if (!empty($merges)) {
            $this->merge($merges);
        }
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Ism kiritilishi shart',
            'last_name.required' => 'Familiya kiritilishi shart',
            'phone.required' => 'Telefon raqam kiritilishi shart',
            'phone.unique' => 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan',
            'password.required' => 'Parol kiritilishi shart',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi shart',
            'password.confirmed' => 'Parollar mos kelmadi',
            'role.in' => 'Noto\'g\'ri foydalanuvchi toifasi tanlandi',
        ];
    }
}
