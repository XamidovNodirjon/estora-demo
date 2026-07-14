<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a new client user.
     *
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $clientRole = Role::where('name', 'client')->first();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'] ?? null,
            'phone' => $data['phone'] ?? null,
            'passport' => $data['passport'] ?? null,
            'jshshir' => $data['jshshir'] ?? null,
            'password' => Hash::make($data['password']),
            'role_id' => $clientRole ? $clientRole->id : null,
            'type' => 'client',
            'status' => 1, // Active by default
        ]);
    }

    /**
     * Authenticate user credentials.
     * Supports both email and username as identifiers.
     *
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $authData = [
            $loginField => $credentials['login'],
            'password' => $credentials['password']
        ];

        $remember = isset($credentials['remember']) && $credentials['remember'];

        if (Auth::attempt($authData, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }

    /**
     * Log out the authenticated user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
