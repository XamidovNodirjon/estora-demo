<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display seller profile and all their announcements.
     * Supports resolving by username or id.
     */
    public function show(Request $request, $user)
    {
        if ($user instanceof User) {
            $userModel = $user;
        } else {
            $userModel = User::where('username', $user)
                ->orWhere('id', is_numeric($user) ? (int)$user : 0)
                ->firstOrFail();
        }

        $user = $userModel;
        $userRole = $user->role?->name ?? $user->type;

        $query = Product::where('user_id', $user->id)
            ->with(['region', 'city', 'category', 'subCategory', 'metros', 'universities', 'items', 'views']);

        // Qidiruv: e'lon nomi, manzil yoki ID (10000 + id ko'rinishida ham)
        if ($request->filled('q')) {
            $term = trim($request->input('q'));
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('landmark', 'like', "%{$term}%");
                if (ctype_digit($term)) {
                    $q->orWhere('id', (int) $term)->orWhere('id', (int) $term - 10000);
                }
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', (int) $request->input('category_id'));
        }

        match ($request->input('sort')) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'oldest' => $query->oldest(),
            default => $query->orderByDesc('is_top')->latest(),
        };

        $products = $query->paginate(8)->withQueryString();

        $allProducts = Product::where('user_id', $user->id);
        $totalCount = (clone $allProducts)->count();
        $categories = \App\Models\Category::whereIn('id', (clone $allProducts)->select('category_id'))->pluck('name', 'id');
        $totalViews = \App\Models\ProductView::whereIn('product_id', (clone $allProducts)->select('id'))->count();
        $trust = app(\App\Services\ProductService::class)->getVerificationStatus($user)['percentage'];

        return view('users.show', compact('user', 'userRole', 'products', 'totalCount', 'categories', 'totalViews', 'trust'));
    }
}
