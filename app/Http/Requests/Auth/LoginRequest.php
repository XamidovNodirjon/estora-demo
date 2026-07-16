<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'login' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Login talab qilinadi',
            'password.required' => 'Parol talab qilinadi',
        ];
    }

    public function attributes(): array
    {
        return [
            'login' => 'Login',
            'password' => 'Parol',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'login' => $this->login ?? $this->username,
        ]);
    }
}
