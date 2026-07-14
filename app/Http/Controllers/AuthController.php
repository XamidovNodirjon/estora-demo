<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
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
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);

        if ($this->authService->login($credentials)) {
            return redirect()->intended(route('dashboard'))
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
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users|alpha_dash',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
        ]);

        $user = $this->authService->register($data);

        // Auto-login after registration
        Auth::login($user);

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
