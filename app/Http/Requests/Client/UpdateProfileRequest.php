<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $userId,
            'phone' => 'nullable|string|max:30|unique:users,phone,' . $userId,
            'passport' => 'nullable|string|max:30',
            'jshshir' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    /**
     * Custom validation messages in Uzbek.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ism va familiyani kiritish majburiy.',
            'name.max' => 'Ism va familiya 255 ta belgidan oshmasligi kerak.',
            'email.required' => 'Elektron pochtani kiritish majburiy.',
            'email.email' => 'Elektron pochta manzili to\'g\'ri formatda bo\'lishi kerak.',
            'email.unique' => 'Ushbu elektron pochta allaqachon boshqa hisob tomonidan band qilingan.',
            'username.required' => 'Foydalanuvchi nomini (username) kiritish majburiy.',
            'username.alpha_dash' => 'Username faqat lotin harflari, raqamlar, defis (-) va pastki chiziqdan (_) iborat bo\'lishi kerak.',
            'username.unique' => 'Ushbu foydalanuvchi nomi allaqachon band qilingan.',
            'phone.unique' => 'Ushbu telefon raqam allaqachon ro\'yxatdan o\'tgan.',
            'password.min' => 'Yangi parol kamida 6 ta belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parolni tasdiqlash mos kelmadi.',
        ];
    }
}
