<?php

namespace App\Services;

use App\DTOs\RegisterDto;
use App\Models\User;
use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    /**
     * Register a new client user.
     *
     * @param RegisterDto $dto
     * @return User
     */
    public function register(RegisterDto $dto): User
    {
        $roleName = in_array($dto->role, ['client', 'makler']) ? $dto->role : 'client';
        $userRole = Role::where('name', $roleName)->first() ?? Role::where('name', 'client')->first();
        
        $data = $dto->toArray();
        unset($data['role']); // Remove transient role key from array before user creation if needed
        $data['password'] = Hash::make($dto->password);
        $data['role_id'] = $userRole ? $userRole->id : null;
        $data['type'] = $roleName;
        $data['status'] = 1; // Active by default

        return $this->userRepository->create($data);
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
