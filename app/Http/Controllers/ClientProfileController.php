<?php

namespace App\Http\Controllers;

use App\DTOs\ProfileUpdateDto;
use App\Http\Requests\Client\UpdateProfileRequest;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    public function __construct(
        protected UserProfileService $profileService
    ) {}

    /**
     * Update the authenticated makler/client profile information.
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $dto = ProfileUpdateDto::fromArray($request->validated());
        $user = Auth::user();

        $this->profileService->updateProfile($user, $dto);

        return redirect()->route('client.dashboard', ['section' => 'my_page'])
            ->with('success', 'Shaxsiy ma\'lumotlaringiz muvaffaqiyatli yangilandi!');
    }
}
