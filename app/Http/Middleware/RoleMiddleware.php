<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $this->resolveRoleValue($role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

    private function resolveRoleValue($role)
    {
        return match ($role) {
            'user' => 1,
            'admin' => 0,
            default => null,
        };
    }
}
