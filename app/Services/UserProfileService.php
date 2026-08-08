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

        $this->userRepository->update($user, $data);

        return $user->fresh();
    }
}
