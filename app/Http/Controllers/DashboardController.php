<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect to the correct dashboard based on role.
     */
    public function index()
    {
        $user = Auth::user();
        $roleName = $user->role?->name ?? $user->type ?? 'client';

        switch ($roleName) {
            case 'dev':
                return redirect()->route('developer.dashboard');
            case 'admin':
            case 'manager':
                return redirect()->route('admin.dashboard');
            case 'makler':
            case 'client':
            default:
                return redirect()->route('client.dashboard');
        }
    }

    /**
     * Developer Dashboard view.
     */
    public function developer()
    {
        return view('developer.dashboard');
    }

    /**
     * Admin/Staff Dashboard view.
     */
    public function admin()
    {
        $clientsCount = User::whereHas('role', function($query) {
            $query->where('name', 'client');
        })->count();

        $productsCount = Product::count();
        $pendingCount = 0;
        $incomeAmount = 0;

        return view('admin.dashboard', compact('clientsCount', 'productsCount', 'pendingCount', 'incomeAmount'));
    }

    /**
     * Client / Makler Dashboard view.
     */
    public function client(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->role?->name ?? $user->type;
        
        // All products created ONLY by the current authenticated user
        $userProducts = \App\Models\Product::where('user_id', $user->id)
            ->with(['region', 'city', 'category', 'subCategory', 'metros', 'universities', 'items', 'views'])
            ->latest()
            ->get();
        $productCount = $userProducts->count();

        // Total views across user's products
        $totalViews = $userProducts->sum(function($product) {
            return $product->views->count();
        });

        // Top viewed product
        $topViewedProduct = $userProducts->sortByDesc(function($product) {
            return $product->views->count();
        })->first();

        // Average views per product
        $avgViews = $productCount > 0 ? round($totalViews / $productCount, 1) : 0;

        // All products favorited by the user
        $favoriteProducts = $user->favorites()
            ->with(['region', 'city', 'category', 'subCategory', 'metros', 'universities', 'items', 'views'])
            ->latest()
            ->get();
        $favoriteCount = $favoriteProducts->count();

        $verificationStatus = app(\App\Services\ProductService::class)->getVerificationStatus($user);
        $isLimitReached = ($userRole === 'client' && $productCount >= 2);
        $canCreateProduct = app(\App\Services\ProductService::class)->canUserCreateProduct($user);

        $section = $request->query('section', 'my_products');

        $conversations = collect();
        $unreadNotificationCount = $user->unreadNotifications->count();
        if ($section === 'chats') {
            $conversations = app(\App\Services\MessageService::class)->getUserConversations($user);
        }

        // Weekly views calculation (last 7 days)
        $userProductIds = $userProducts->pluck('id')->toArray();
        $weeklyViewsData = [];
        $dayNames = [
            1 => 'Dush',
            2 => 'Sesh',
            3 => 'Chor',
            4 => 'Pay',
            5 => 'Juma',
            6 => 'Shan',
            7 => 'Yak',
        ];

        for ($i = 6; $i >= 0; $i--) {
            $targetDate = now()->subDays($i);
            $dayOfWeek = $targetDate->dayOfWeekIso; // 1 (Mon) to 7 (Sun)
            $count = empty($userProductIds) ? 0 : \App\Models\ProductView::whereIn('product_id', $userProductIds)
                ->whereDate('created_at', $targetDate->toDateString())
                ->count();
            
            $weeklyViewsData[] = [
                'day' => $dayNames[$dayOfWeek] ?? $targetDate->format('D'),
                'full_date' => $targetDate->format('d.m'),
                'count' => $count,
            ];
        }

        $maxWeeklyCount = max(array_column($weeklyViewsData, 'count') ?: [1]);
        if ($maxWeeklyCount == 0) $maxWeeklyCount = 1;

        foreach ($weeklyViewsData as &$dayItem) {
            $heightPercent = round(($dayItem['count'] / $maxWeeklyCount) * 100);
            $dayItem['height'] = max(12, $heightPercent); // at least 12% so bar is visible
        }
        unset($dayItem);

        return view('client.dashboard', compact(
            'user', 'userRole', 'userProducts', 'productCount', 'totalViews',
            'topViewedProduct', 'avgViews', 'favoriteProducts', 'favoriteCount',
            'isLimitReached', 'canCreateProduct', 'verificationStatus', 'section', 'conversations', 'unreadNotificationCount',
            'weeklyViewsData'
        ));
    }
}
