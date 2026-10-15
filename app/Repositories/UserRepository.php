<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findByGoogleId(string $googleId): ?User
    {
        return User::where('google_id', $googleId)->first();
    }

    /**
     * Find user by phone regardless of stored format
     * (+998901234567, 998901234567, "+998 90 123 45 67", ...).
     */
    public function findByPhone(string $formattedPhone): ?User
    {
        $digits = preg_replace('/[^\d]/', '', $formattedPhone);

        return User::whereIn('phone', array_unique([$formattedPhone, $digits, substr($digits, -9)]))
            ->orWhereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '+', ''), '(', ''), ')', '') = ?", [$digits])
            ->first();
    }

    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    /**
     * Update user with given data array.
     */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
