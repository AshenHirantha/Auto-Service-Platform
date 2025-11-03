<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceStation;
use App\Models\PartsVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Show customer registration form
     */
    public function showCustomerForm()
    {
        return view('auth.register.customer');
    }

    /**
     * Show service station registration form
     */
    public function showServiceStationForm()
    {
        return view('auth.register.service-station');
    }

    /**
     * Show vendor registration form
     */
    public function showVendorForm()
    {
        return view('auth.register.vendor');
    }

    /**
     * Handle customer registration
     */
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'customer',
            'is_active' => true, // Customers are automatically active
        ]);

        // Assign customer role if using Spatie Permission
        if (class_exists('\Spatie\Permission\Models\Role')) {
            $user->assignRole('customer');
        }

        // Log in the user
        Auth::login($user);

        return redirect('/customer')->with('success', 'Registration successful! Welcome to Auto Service Platform.');
    }

    /**
     * Handle service station registration
     */
    public function registerServiceStation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'station_name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'business_hours' => 'required|string|max:100',
            'specializations' => 'required|string',
            'tax_info' => 'required|string|max:100',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'service_station',
            'is_active' => false, // Requires admin approval
        ]);

        // Create service station record
        ServiceStation::create([
            'name' => $request->station_name,
            'location' => $request->location,
            'contact' => $request->phone,
            'business_hours' => $request->business_hours,
            'specializations' => $request->specializations,
            'tax_info' => $request->tax_info,
            'is_verified' => false,
            'rating' => 0,
            'owner_id' => $user->id,
        ]);

        // Assign service station role if using Spatie Permission
        if (class_exists('\Spatie\Permission\Models\Role')) {
            $user->assignRole('service_station');
        }

        return redirect('/login/service-station')->with('success', 
            'Registration submitted successfully! Your account is pending approval. You will be notified via email once approved.');
    }

    /**
     * Handle vendor registration
     */
    public function registerVendor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vendor_name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'business_hours' => 'required|string|max:100',
            'tax_info' => 'required|string|max:100',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'vendor',
            'is_active' => false, // Requires admin approval
        ]);

        // Create vendor record
        PartsVendor::create([
            'name' => $request->vendor_name,
            'location' => $request->location,
            'contact' => $request->phone,
            'business_hours' => $request->business_hours,
            'tax_info' => $request->tax_info,
            'is_verified' => false,
            'rating' => 0,
            'owner_id' => $user->id,
        ]);

        // Assign vendor role if using Spatie Permission
        if (class_exists('\Spatie\Permission\Models\Role')) {
            $user->assignRole('vendor');
        }

        return redirect('/login/vendor')->with('success', 
            'Registration submitted successfully! Your account is pending approval. You will be notified via email once approved.');
    }
}