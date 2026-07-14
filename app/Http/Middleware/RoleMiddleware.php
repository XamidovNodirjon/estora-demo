<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check user's role relation
        if ($user->role && in_array($user->role->name, $roles)) {
            return $next($request);
        }

        abort(403, 'Ushbu sahifaga kirish huquqingiz yo\'q.');
    }
}
