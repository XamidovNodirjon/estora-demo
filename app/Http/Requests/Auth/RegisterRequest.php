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
            'username' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
            'role' => 'nullable|string|in:client,owner,makler,hotel,builder',
        ];
    }

    protected function prepareForValidation(): void
    {
        $firstName = trim($this->first_name ?? '');
        $lastName = trim($this->last_name ?? '');

        $dataToMerge = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => trim("{$firstName} {$lastName}"),
        ];

        if ($this->has('username') && $this->username) {
            $dataToMerge['username'] = strtolower(trim($this->username));
        }

        if ($this->has('passport') && $this->passport) {
            $dataToMerge['passport'] = strtoupper(trim($this->passport));
        }

        if ($this->has('jshshir') && $this->jshshir) {
            $dataToMerge['jshshir'] = trim($this->jshshir);
        }

        $this->merge($dataToMerge);
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Ismni kiritish shart',
            'last_name.required' => 'Familiyani kiritish shart',
            'phone.required' => 'Telefon raqam kiritilishi shart',
            'phone.unique' => 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan',
            'password.required' => 'Parol kiritilishi shart',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi shart',
            'password.confirmed' => 'Parollar mos kelmadi',
            'role.in' => 'Noto\'g\'ri foydalanuvchi toifasi tanlandi',
        ];
    }
}
