<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserTypeAccess
{
    public function handle(Request $request, Closure $next, string $requiredType): Response
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending approval.');
        }

        if ($user->user_type !== $requiredType) {
            return redirect()->route($user->user_type . '.dashboard')
                          ->with('error', 'You do not have access to this area.');
        }

        return $next($request);
    }
}