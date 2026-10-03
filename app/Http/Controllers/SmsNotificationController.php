<?php

namespace App\Http\Controllers;

use App\Models\SmsNotification;
use App\Services\UsmsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SmsNotificationController extends Controller
{
    protected UsmsService $usmsService;

    public function __construct(UsmsService $usmsService)
    {
        $this->usmsService = $usmsService;
    }

    /**
     * Display SMS notifications index for Developer Panel.
     */
    public function developerIndex(Request $request)
    {
        return $this->renderIndex($request, 'layouts.developer', 'developer.sms-notifications');
    }

    /**
     * Display SMS notifications index for Admin Panel.
     */
    public function adminIndex(Request $request)
    {
        return $this->renderIndex($request, 'layouts.admin', 'admin.sms-notifications');
    }

    /**
     * Shared render logic for SMS notifications view.
     */
    protected function renderIndex(Request $request, string $layout, string $routePrefix)
    {
        $query = SmsNotification::query()->latest('id');

        // Filter by status
        if ($request->filled('status') && in_array($request->status, ['sent', 'pending', 'failed'])) {
            $query->where('status', $request->status);
        }

        // Search by phone number or code
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('phone', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $smsNotifications = $query->paginate(20)->withQueryString();

        // Statistics
        $totalCount   = SmsNotification::count();
        $todayCount   = SmsNotification::whereDate('created_at', today())->count();
        $sentCount    = SmsNotification::where('status', 'sent')->count();
        $failedCount  = SmsNotification::where('status', 'failed')->count();
        $pendingCount = SmsNotification::where('status', 'pending')->count();

        // USMS Balance - only retrieved from Cache. External API is NOT called automatically here!
        $cachedBalanceData = Cache::get('usms_balance_data');
        $balanceUpdatedAt  = Cache::get('usms_balance_updated_at');

        return view('sms.index', compact(
            'smsNotifications',
            'totalCount',
            'todayCount',
            'sentCount',
            'failedCount',
            'pendingCount',
            'cachedBalanceData',
            'balanceUpdatedAt',
            'layout',
            'routePrefix'
        ));
    }

    /**
     * On-demand refresh of USMS.uz balance via API.
     * URL: https://usms.uz/api/v1/balance
     * Triggered strictly when user clicks "Yangilash" button!
     */
    public function refreshBalance(Request $request): JsonResponse
    {
        $result = $this->usmsService->getBalance();

        $updatedAt = now()->format('d.m.Y H:i:s');

        if ($result['success']) {
            Cache::put('usms_balance_data', $result, now()->addHours(24));
            Cache::put('usms_balance_updated_at', $updatedAt, now()->addHours(24));

            return response()->json([
                'success'           => true,
                'balance'           => $result['balance'],
                'currency'          => $result['currency'] ?? 'UZS',
                'formatted_balance' => $result['formatted_balance'],
                'updated_at'        => $updatedAt,
                'message'           => 'USMS balansi muvaffaqiyatli yangilandi.',
            ]);
        }

        return response()->json([
            'success'           => false,
            'message'           => $result['message'] ?? 'Balansni olishda xatolik yuz berdi.',
            'raw'               => $result['raw'] ?? null,
            'updated_at'        => $updatedAt,
        ], 400);
    }
}
