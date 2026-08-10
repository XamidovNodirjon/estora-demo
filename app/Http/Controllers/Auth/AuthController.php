<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authService->login($credentials)) {
            session()->forget('url.intended');
            return redirect()->route('dashboard')
                ->with('success', 'Tizimga muvaffaqiyatli kirdingiz!');
        }

        return back()->withErrors([
            'login' => 'Kiritilgan ma\'lumotlar noto\'g\'ri.',
        ])->withInput($request->only('login'));
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(RegisterRequest $request)
    {
        $dto = RegisterDto::fromArray($request->validated());
        $user = $this->authService->register($dto);

        // Auto-login after registration
        Auth::login($user);
        session()->forget('url.intended');

        return redirect()->route('dashboard')
            ->with('success', 'Ro\'yxatdan muvaffaqiyatli o\'tdingiz!');
    }

    /**
     * Handle logout request.
     */
    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')
            ->with('success', 'Tizimdan chiqdingiz.');
    }
}
