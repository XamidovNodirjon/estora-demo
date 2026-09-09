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
        $fullName = trim($this->full_name ?? '');
        $firstName = trim($this->first_name ?? '');
        $lastName = trim($this->last_name ?? '');

        if ($fullName !== '') {
            $parts = preg_split('/\s+/', $fullName, 2);
            $firstName = $firstName !== '' ? $firstName : ($parts[0] ?? '');
            $lastName = $lastName !== '' ? $lastName : ($parts[1] ?? $parts[0] ?? '');
        }

        $dataToMerge = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => trim("{$firstName} {$lastName}"),
        ];

        // Agar formadan bitta password kelsa, password_confirmation ni ham tenglaymiz
        if ($this->has('password') && !$this->filled('password_confirmation')) {
            $dataToMerge['password_confirmation'] = $this->password;
        }

        // Telefon raqamni tozalash va formatlash (+998...)
        if ($this->has('phone') && $this->phone) {
            $rawPhone = trim($this->phone);
            $hasPlus = str_starts_with($rawPhone, '+');
            $digits = preg_replace('/[^\d]/', '', $rawPhone);
            if (strlen($digits) === 9) {
                $dataToMerge['phone'] = '+998' . $digits;
            } elseif (strlen($digits) === 12 && str_starts_with($digits, '998')) {
                $dataToMerge['phone'] = '+' . $digits;
            } elseif ($digits !== '') {
                $dataToMerge['phone'] = ($hasPlus ? '+' : '+998') . $digits;
            }
        }

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
            'first_name.required' => 'Ism familiyangizni kiriting',
            'last_name.required' => 'Ism familiyangizni to\'liq kiriting',
            'phone.required' => 'Telefon raqam kiritilishi shart',
            'phone.unique' => 'Bu telefon raqam allaqachon ro\'yxatdan o\'tgan',
            'password.required' => 'Parol kiritilishi shart',
            'password.min' => 'Parol kamida 6 ta belgidan iborat bo\'lishi shart',
            'password.confirmed' => 'Parollar mos kelmadi',
            'role.in' => 'Noto\'g\'ri foydalanuvchi toifasi tanlandi',
        ];
    }
}
