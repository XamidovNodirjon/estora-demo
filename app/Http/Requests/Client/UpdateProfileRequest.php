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
            'passport' => 'nullable|string|min:7|max:20|unique:users,passport,' . $userId,
            'jshshir' => 'nullable|string|size:14|regex:/^[0-9]{14}$/|unique:users,jshshir,' . $userId,
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
            'email.unique' => 'Ushbu elektron pochta boshqa foydalanuvchi hisobida allaqachon ro\'yxatdan o\'tgan.',
            'username.required' => 'Foydalanuvchi nomini (username) kiritish majburiy.',
            'username.alpha_dash' => 'Username faqat lotin harflari, raqamlar, defis (-) va pastki chiziqdan (_) iborat bo\'lishi kerak.',
            'username.unique' => 'Ushbu foydalanuvchi nomi allaqachon band qilingan.',
            'phone.unique' => 'Ushbu telefon raqam allaqachon ro\'yxatdan o\'tgan.',
            'passport.min' => 'Pasport seriya va raqami to\'liq kiritilishi kerak (masalan: AA1234567).',
            'passport.unique' => 'Ushbu pasport seriya va raqami boshqa foydalanuvchi hisobida allaqachon mavjud!',
            'jshshir.size' => 'JShShIR 14 ta raqamdan iborat bo\'lishi kerak.',
            'jshshir.regex' => 'JShShIR faqat 14 ta raqamdan iborat bo\'lishi kerak.',
            'jshshir.unique' => 'Ushbu 14 xonali JShShIR boshqa foydalanuvchi hisobida allaqachon mavjud! Siz boshqa birovning JShShIR raqamini kirita olmaysiz.',
            'password.min' => 'Yangi parol kamida 6 ta belgidan iborat bo\'lishi kerak.',
            'password.confirmed' => 'Parolni tasdiqlash mos kelmadi.',
        ];
    }
}
