<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if ($this->authService->login($credentials)) {
            session()->forget('url.intended');
            return redirect()->route('dashboard')->with('success', 'Tizimga muvaffaqiyatli kirdingiz!');
        }

        return back()->withErrors(['login' => 'Kiritilgan ma\'lumotlar noto\'g\'ri.'])->withInput($request->only('login'));
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $dto = RegisterDto::fromArray($request->validated());
        $user = $this->authService->register($dto);

        Auth::login($user);
        session()->forget(['url.intended', 'verified_phone', 'verified_token']);

        return redirect()->route('dashboard')
            ->with('success', 'Ro\'yxatdan muvaffaqiyatli o\'tdingiz!');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')
            ->with('success', 'Tizimdan chiqdingiz.');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request)
    {
        if ($request->has('role')) {
            session(['oauth_preferred_role' => $request->get('role')]);
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['login' => 'Google orqali kirishda xatolik yuz berdi: ' . $e->getMessage()]);
        }

        $preferredRole = session()->pull('oauth_preferred_role', 'client');
        $user = $this->authService->findOrCreateGoogleUser($googleUser, $preferredRole);

        Auth::login($user, true);

        $intendedUrl = session()->pull('url.intended');
        if ($intendedUrl) {
            return redirect()->to($intendedUrl);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Google orqali muvaffaqiyatli kirdingiz!');
    }
}
