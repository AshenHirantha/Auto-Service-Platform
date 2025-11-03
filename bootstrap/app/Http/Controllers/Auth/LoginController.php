<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';

    // Remove the constructor with middleware - we'll handle this in routes instead
    
    /**
     * Show the login form for different user types
     */
    public function showLoginForm(Request $request, $type = null)
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return $this->redirectBasedOnUserType(Auth::user());
        }

        $userType = $type ?: 'customer';
        
        $panelConfig = [
            'customer' => [
                'title' => 'Customer Login',
                'description' => 'Access your vehicle service history and book appointments',
                'register_url' => '/customer/register',
                'panel_url' => '/customer',
                'color' => 'green',
            ],
            'service-station' => [
                'title' => 'Service Station Login',
                'description' => 'Manage your service operations and appointments',
                'register_url' => '/service-station/register',
                'panel_url' => '/service-station',
                'color' => 'orange',
            ],
            'vendor' => [
                'title' => 'Parts Vendor Login',
                'description' => 'Manage your parts inventory and orders',
                'register_url' => '/vendor/register',
                'panel_url' => '/vendor',
                'color' => 'purple',
            ],
            'admin' => [
                'title' => 'Administrator Login',
                'description' => 'System administration and management',
                'register_url' => null,
                'panel_url' => '/admin',
                'color' => 'blue',
            ],
        ];

        return view('auth.login', [
            'config' => $panelConfig[$userType],
            'userType' => $userType,
        ]);
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return $this->redirectBasedOnUserType(Auth::user());
        }

        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Get credentials
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => true, // Only allow active users
        ];

        // Remember me
        $remember = $request->boolean('remember');

        // Attempt to authenticate
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Additional check for account status
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is pending approval.',
                ])->onlyInput('email');
            }

            // Redirect based on user type
            return $this->redirectBasedOnUserType($user);
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Redirect user based on their type
     */
    protected function redirectBasedOnUserType(User $user)
    {
        $redirectUrls = [
            'admin' => '/admin',
            'customer' => '/customer',
            'service_station' => '/service-station',
            'vendor' => '/vendor',
        ];

        $redirectUrl = $redirectUrls[$user->user_type] ?? $this->redirectTo;
        
        return redirect()->intended($redirectUrl);
    }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}