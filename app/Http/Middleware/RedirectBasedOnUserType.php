<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnUserType
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is pending approval.');
            }

            // Redirect based on user type
            $dashboardRoutes = [
                'customer' => '/customer',
                'service_station' => '/service-station',
                'vendor' => '/vendor',
                'admin' => '/admin',
            ];

            if (isset($dashboardRoutes[$user->user_type])) {
                return redirect($dashboardRoutes[$user->user_type]);
            }
        }

        return $next($request);
    }
}