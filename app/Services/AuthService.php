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
        $allowedRoles = ['client', 'owner', 'makler', 'hotel', 'builder'];
        $roleName = in_array($dto->role, $allowedRoles) ? $dto->role : 'client';
        $userRole = Role::firstOrCreate(['name' => $roleName]);
        
        $data = $dto->toArray();
        unset($data['role']); // Remove transient role key from array before user creation if needed

        // Auto-generate username if not provided
        if (empty($data['username'])) {
            $lastName = $dto->lastName ?? '';
            $firstName = $dto->firstName ?? '';
            if (empty($lastName) && empty($firstName) && !empty($dto->name)) {
                $parts = explode(' ', trim($dto->name), 2);
                $lastName = $parts[0] ?? '';
                $firstName = $parts[1] ?? '';
            }
            $data['username'] = $this->generateUsername($lastName, $firstName);
        }

        $data['password'] = Hash::make($dto->password);
        $data['role_id'] = $userRole ? $userRole->id : null;
        $data['type'] = $roleName;
        $data['status'] = 1; // Active by default

        return $this->userRepository->create($data);
    }

    /**
     * Generate a unique username from last name and first name.
     * Format: {last_name}_{first_name} (e.g. xamidov_nodirjon)
     */
    public function generateUsername(string $lastName, string $firstName): string
    {
        $raw = trim($lastName) . '_' . trim($firstName);
        $slug = $this->transliterateAndNormalize($raw);

        if (empty($slug)) {
            $slug = 'user_' . substr(uniqid(), -6);
        }

        $base = $slug;
        $counter = 1;
        $candidate = $base;

        while (User::where('username', $candidate)->exists()) {
            $candidate = "{$base}_{$counter}";
            $counter++;
        }

        return $candidate;
    }

    /**
     * Normalize and transliterate names to latin slug format.
     */
    protected function transliterateAndNormalize(string $text): string
    {
        // Replace common Uzbek apostrophes
        $text = str_replace(["o'", "o‘", "oʻ", "o`", "O'", "O‘", "Oʻ", "O`"], ['o', 'o', 'o', 'o', 'o', 'o', 'o', 'o'], $text);
        $text = str_replace(["g'", "g‘", "gʻ", "g`", "G'", "G‘", "Gʻ", "G`"], ['g', 'g', 'g', 'g', 'g', 'g', 'g', 'g'], $text);

        // Cyrillic to Latin map
        $cyrillic = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'ў','қ','ғ','ҳ',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',
            'Ў','Қ','Ғ','Ҳ'
        ];
        $latin = [
            'a','b','v','g','d','e','yo','j','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','x','ts','ch','sh','sh','','y','','e','yu','ya',
            'o','q','g','h',
            'a','b','v','g','d','e','yo','j','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','x','ts','ch','sh','sh','','y','','e','yu','ya',
            'o','q','g','h'
        ];
        $text = str_replace($cyrillic, $latin, $text);

        // Lowercase
        $text = mb_strtolower($text, 'UTF-8');

        // Replace non-alphanumeric with underscore
        $text = preg_replace('/[^a-z0-9]+/u', '_', $text);

        // Deduplicate underscores
        $text = preg_replace('/_+/', '_', $text);

        return trim($text, '_');
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
        $loginInput = $credentials['login'];
        $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $authData = [
            $loginField => $loginInput,
            'password' => $credentials['password']
        ];

        $remember = isset($credentials['remember']) && $credentials['remember'];

        if (Auth::attempt($authData, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        // Fallback: try by phone if login by username failed
        if ($loginField === 'username' && Auth::attempt(['phone' => $loginInput, 'password' => $credentials['password']], $remember)) {
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
