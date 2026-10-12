<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $userId,
            'username' => 'nullable|string|max:255|alpha_dash|unique:users,username,' . $userId,
            'phone' => 'nullable|string|max:30|unique:users,phone,' . $userId,
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Ismni kiritish majburiy.',
            'email.email' => 'Elektron pochta manzili to\'g\'ri formatda bo\'lishi kerak.',
            'email.unique' => 'Ushbu elektron pochta boshqa foydalanuvchi hisobida mavjud.',
            'username.alpha_dash' => 'Username faqat lotin harflari, raqamlar, defis (-) va pastki chiziqdan (_) iborat bo\'lishi kerak.',
            'username.unique' => 'Ushbu foydalanuvchi nomi allaqachon band qilingan.',
            'phone.unique' => 'Ushbu telefon raqam allaqachon ro\'yxatdan o\'tgan.',
            'password.min' => 'Yangi parol kamida 6 ta belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parolni tasdiqlash mos kelmadi.',
        ];
    }
}
