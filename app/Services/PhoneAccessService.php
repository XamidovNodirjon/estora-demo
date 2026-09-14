<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPhoneView;
use App\Models\User;

class PhoneAccessService
{
    /**
     * Check if a user/guest is allowed to reveal and view the listing phone.
     *
     * @return array{allowed: bool, require_auth: bool, message: string}
     */
    public function checkAccess(Product $product, ?User $viewer = null): array
    {
        if ($product->canViewPhone($viewer)) {
            return [
                'allowed' => true,
                'require_auth' => false,
                'message' => 'Ruxsat berilgan',
            ];
        }

        // Owner listing and guest
        return [
            'allowed' => false,
            'require_auth' => true,
            'message' => "Uy egasi (Owner) bilan bog'lanish uchun tizimda ro'yxatdan o'ting yoki tizimga kiring. Ro'yxatdan o'tish bepul va 1 daqiqa vaqt oladi!",
        ];
    }

    /**
     * Reveal the phone number, log the view, and increment phone view counters.
     * Ready for future monetization (credits / daily limits / subscription deduction).
     *
     * @return array{
     *     success: bool,
     *     require_auth?: bool,
     *     phone?: string,
     *     tel_href?: string,
     *     phone_views_count?: int,
     *     is_makler?: bool,
     *     message: string
     * }
     */
    public function revealAndRecord(Product $product, ?User $viewer = null, ?string $ip = null, ?string $userAgent = null): array
    {
        $access = $this->checkAccess($product, $viewer);

        if (!$access['allowed']) {
            return [
                'success' => false,
                'require_auth' => $access['require_auth'],
                'message' => $access['message'],
            ];
        }

        // Real phone number to reveal
        $rawPhone = $product->effective_phone ?: '+998 ** *** ** **';
        $cleanDigits = preg_replace('/[^\d+]/', '', $rawPhone);
        $telHref = 'tel:' . $cleanDigits;

        $sellerRole = $product->isMaklerListing() ? 'makler' : 'owner';

        // 1. Record in product_phone_views log
        ProductPhoneView::create([
            'product_id' => $product->id,
            'viewer_id' => $viewer?->id,
            'seller_id' => $product->user_id,
            'seller_role' => $sellerRole,
            'ip_address' => $ip ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
        ]);

        // 2. Increment aggregated views counter
        $product->increment('phone_views_count');
        $newCount = $product->fresh()->phone_views_count;

        return [
            'success' => true,
            'require_auth' => false,
            'phone' => $rawPhone,
            'tel_href' => $telHref,
            'phone_views_count' => $newCount,
            'is_makler' => $product->isMaklerListing(),
            'message' => "Telefon raqami muvaffaqiyatli ochildi",
        ];
    }
}
