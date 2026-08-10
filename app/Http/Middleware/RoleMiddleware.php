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
        $userRole = $user->role?->name ?? $user->type;

        // Strict check user's role relation or type attribute against allowed roles for the route
        if ($userRole) {
            // Dev has access everywhere
            if ($userRole === 'dev') {
                return $next($request);
            }
            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        abort(403, 'Ushbu sahifaga kirish huquqingiz yo\'q.');
    }
}
