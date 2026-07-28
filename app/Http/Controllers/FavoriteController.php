<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for a product.
     */
    public function toggle(Request $request, Product $product)
    {
        $user = Auth::user();
        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Tizimga kirishingiz kerak.'], 401);
            }
            return redirect()->route('login');
        }

        $attached = $user->favorites()->toggle($product->id);
        $isFavorited = count($attached['attached']) > 0;
        $favoriteCount = $user->favorites()->count();

        $message = $isFavorited 
            ? 'E\'lon saralanganlarga qo\'shildi' 
            : 'E\'lon saralanganlardan olib tashlandi';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'is_favorited' => $isFavorited,
                'favorite_count' => $favoriteCount,
                'message' => $message,
            ]);
        }

        return back()->with('success', $message);
    }
}
