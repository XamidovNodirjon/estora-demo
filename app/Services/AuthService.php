<?php

namespace App\Services;

use App\DTOs\RegisterDto;
use App\Models\User;
use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

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
        $allowedRoles = ['client', 'owner', 'makler', 'hotel', 'builder'];
        $roleName = in_array($dto->role, $allowedRoles) ? $dto->role : 'client';
        $userRole = Role::firstOrCreate(['name' => $roleName]);
        
        $username = $this->generateUniqueUsername($dto->first_name, $dto->last_name, $dto->username);

        $data = $dto->toArray();
        unset($data['role']); // Remove transient role key from array before user creation if needed
        $data['first_name'] = $dto->first_name;
        $data['last_name'] = $dto->last_name;
        $data['name'] = trim("{$dto->first_name} {$dto->last_name}");
        $data['username'] = $username;
        $data['password'] = Hash::make($dto->password);
        $data['role_id'] = $userRole ? $userRole->id : null;
        $data['type'] = $roleName;
        $data['status'] = 1; // Active by default

        return $this->userRepository->create($data);
    }

    /**
     * Generate an automated, unique snake_case username from user's first and last name.
     */
    public function generateUniqueUsername(string $firstName, string $lastName, ?string $desired = null): string
    {
        $base = !empty($desired) ? $desired : ($firstName . '_' . $lastName);

        $replace = [
            "o'" => 'o', "O'" => 'o', "o‘" => 'o', "O‘" => 'o', "o`" => 'o', "O`" => 'o', "oʻ" => 'o', "Oʻ" => 'o',
            "g'" => 'g', "G'" => 'g', "g‘" => 'g', "G‘" => 'g', "g`" => 'g', "G`" => 'g', "gʻ" => 'g', "Gʻ" => 'g',
            "sh" => 'sh', "ch" => 'ch',
        ];
        $base = str_ireplace(array_keys($replace), array_values($replace), $base);

        $slug = Str::slug($base, '_');
        if (empty($slug)) {
            $slug = 'user_' . random_int(1000, 9999);
        }

        $username = strtolower($slug);
        $candidate = $username;
        $counter = 1;

        while (User::where('username', $candidate)->exists()) {
            $candidate = $username . '_' . $counter;
            $counter++;
        }

        return $candidate;
    }

    /**
     * Authenticate user credentials.
     * Supports email, username, and phone as identifiers.
     *
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        $login = trim($credentials['login']);
        $password = $credentials['password'];
        $remember = isset($credentials['remember']) && $credentials['remember'];

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['email' => $login, 'password' => $password], $remember)) {
                request()->session()->regenerate();
                return true;
            }
        }

        if (Auth::attempt(['username' => $login, 'password' => $password], $remember)) {
            request()->session()->regenerate();
            return true;
        }

        if (Auth::attempt(['phone' => $login, 'password' => $password], $remember)) {
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
