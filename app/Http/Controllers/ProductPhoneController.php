<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\PhoneAccessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductPhoneController extends Controller
{
    public function __construct(
        protected PhoneAccessService $phoneAccessService
    ) {}

    /**
     * Reveal product phone number and log the view.
     * Makler listings are freely revealable by anyone.
     * Owner listings require registration/login.
     */
    public function reveal(Request $request, Product $product): JsonResponse
    {
        $viewer = Auth::user();
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        $result = $this->phoneAccessService->revealAndRecord($product, $viewer, $ip, $userAgent);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'require_auth' => $result['require_auth'] ?? false,
                'message' => $result['message'],
                'register_url' => route('register'),
                'login_url' => route('login'),
            ], 401);
        }

        return response()->json([
            'success' => true,
            'phone' => $result['phone'],
            'tel_href' => $result['tel_href'],
            'phone_views_count' => $result['phone_views_count'],
            'is_makler' => $result['is_makler'],
            'message' => $result['message'],
        ]);
    }
}
