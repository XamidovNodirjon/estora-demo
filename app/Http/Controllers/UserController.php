<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display seller profile and all their announcements.
     */
    public function show(User $user)
    {
        $userRole = $user->role?->name ?? $user->type;

        $products = Product::where('user_id', $user->id)
            ->with(['region', 'city', 'category', 'subCategory', 'metros', 'universities', 'items', 'views'])
            ->latest()
            ->paginate(12);

        $totalCount = Product::where('user_id', $user->id)->count();

        return view('users.show', compact('user', 'userRole', 'products', 'totalCount'));
    }
}
