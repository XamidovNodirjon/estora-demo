<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $devRole = \App\Models\Role::where('name', 'dev')->first();
        $devRoleId = $devRole ? $devRole->id : null;

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users|alpha_dash',
            'phone' => 'nullable|string|unique:users',
            'password' => 'required|string|min:6',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
        ];

        if (auth()->check() && auth()->user()->role && auth()->user()->role->name !== 'dev') {
            $rules['role_id'] = 'required|exists:roles,id|not_in:' . $devRoleId;
            $rules['type'] = 'required|string|in:admin,manager,client';
        } else {
            $rules['role_id'] = 'required|exists:roles,id';
            $rules['type'] = 'required|string|in:dev,admin,manager,client';
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Ism maydoni to\'ldirilishi shart.',
            'email.required' => 'Email maydoni to\'ldirilishi shart.',
            'email.email' => 'Iltimos, to\'g\'ri email manzilini kiriting.',
            'email.unique' => 'Bu email manzil allaqachon ishlatilgan.',
            'username.required' => 'Foydalanuvchi nomi maydoni to\'ldirilishi shart.',
            'username.unique' => 'Bu foydalanuvchi nomi allaqachon ishlatilgan.',
            'username.alpha_dash' => 'Foydalanuvchi nomi faqat harflar, raqamlar va pastki chiziqlarni o\'z ichiga olishi mumkin.',
            'phone.unique' => 'Bu telefon raqami allaqachon ishlatilgan.',
            'password.required' => 'Parol maydoni to\'ldirilishi shart.',
            'password.min' => 'Parol kamida :min belgidan iborat bo\'lishi kerak.',
            'role_id.required' => 'Rol maydoni to\'ldirilishi shart.',
            'role_id.exists' => 'Tanlangan rol mavjud emas.',
            'type.required' => 'Turi maydoni to\'ldirilishi shart.',
            'type.in' => 'Tanlangan turi noto\'g\'ri.',
        ];
    }
}
