<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Username bo'yicha: email bo'lsa emailga, bo'lmasa telefon raqamga kod yuboriladi.
     * Telefon bo'yicha: SMS orqali kod yuboriladi.
     */
    public function sendCode(ForgotPasswordRequest $request): JsonResponse
    {
        $method = $request->validated('method');

        $result = $this->service->sendCode($method, (string) $request->validated($method));

        return response()->json(['success' => true] + $result);
    }

    public function verifyCode(Request $request): JsonResponse
    {
        $request->merge(['code' => preg_replace('/[^\d]/', '', (string) $request->code)]);
        $request->validate(
            ['code' => ['required', 'digits:6']],
            ['code.*' => "6 xonali tasdiqlash kodini kiriting."]
        );

        return response()->json(['success' => true] + $this->service->verifyCode($request->code));
    }

    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        $this->service->resetPassword($request->resetUser,$request->validated('username'), $request->validated('password'));

        session()->flash('success', 'Parolingiz muvaffaqiyatli yangilandi. Yangi ma\'lumotlar bilan tizimga kiring.');

        return response()->json([
            'success' => true,
            'redirect' => route('login'),
        ]);
    }
}
