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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return abort(403, 'Unauthorized access.');
        }
        // Get the user's role
        $userRole = Auth::user()->role;

        // Check if the user's role is in the allowed roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // If the user's role is not allowed, deny access
        return abort(403, 'Unauthorized access.');
    }
}
