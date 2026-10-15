<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Services\PasswordResetService;

class ForgotPasswordController extends Controller
{
    public function __construct(
        protected PasswordResetService $service
    ) {}

    public function showForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Telefon tizimda bo'lsa - username va yangi parol SMS orqali yuboriladi.
     */
    public function send(ForgotPasswordRequest $request)
    {
        $result = $this->service->resetByPhone($request->validated('phone'));

        $redirect = redirect()->route('login')
            ->with('success', 'Login va yangi parolingiz telefon raqamingizga SMS orqali yuborildi.');

        // Faqat SMS test (mock) rejimida: haqiqiy SMS ketmaydi, shuning uchun ekranda ko'rsatamiz
        if ($result['password']) {
            $redirect->with('reset_mock_credentials', $result);
        }

        return $redirect;
    }
}
