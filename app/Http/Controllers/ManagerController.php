<?php

namespace App\Http\Controllers;

use App\DTOs\ProfileUpdateDto;
use App\Http\Requests\Manager\UpdateProfileRequest;
use App\Services\LeadService;
use App\Services\ProductService;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function __construct(
        protected LeadService $leadService,
        protected ProductService $productService,
        protected UserProfileService $profileService
    ) {}

    /**
     * Manager cabinet dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $leadsCount = $this->leadService->countManagerLeads($user);
        $assignedProductsCount = $this->productService->countAssignedProducts($user);
        $ownProductsCount = $this->productService->countOwnProducts($user);
        $latestLeads = $this->leadService->getLatestManagerLeads($user, 5);
        $statusCounts = $this->leadService->getStatusCounts($user);

        return view('manager.dashboard', compact('user', 'leadsCount', 'assignedProductsCount', 'ownProductsCount', 'latestLeads', 'statusCounts'));
    }

    /**
     * Manager personal information.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('manager.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $dto = ProfileUpdateDto::fromArray($request->validated());
        $this->profileService->updateProfile(Auth::user(), $dto);

        return redirect()->route('manager.profile')
            ->with('success', 'Shaxsiy ma\'lumotlaringiz muvaffaqiyatli yangilandi!');
    }
}
