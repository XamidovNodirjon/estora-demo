<?php

namespace App\Services;

use App\DTOs\ProfileUpdateDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserProfileService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    /**
     * Update client/makler profile information from DTO.
     *
     * @param User $user
     * @param ProfileUpdateDto $dto
     * @return User
     */
    public function updateProfile(User $user, ProfileUpdateDto $dto): User
    {
        $data = $dto->toArray();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // If email was changed, reset email verification timestamp
        if (isset($data['email']) && strtolower(trim($data['email'])) !== strtolower(trim($user->email))) {
            $data['email_verified_at'] = null;
        }

        $this->userRepository->update($user, $data);

        return $user->fresh();
    }
}
