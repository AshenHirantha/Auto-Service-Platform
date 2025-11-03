<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $user->loadMissing('partsVendor');
        return view('vendor.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.$user->id],
            'password' => ['nullable','string','min:8','confirmed'],
            'vendor_name' => ['nullable','string','max:100'],
            'vendor_contact' => ['nullable','string','max:100'],
            'vendor_location' => ['nullable','string','max:255'],
            'vendor_business_hours' => ['nullable','string','max:100'],
            'vendor_tax_info' => ['nullable','string','max:100'],
        ]);

        // Update user fields
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        // Update or create vendor fields (keep existing when blanks)
        $vendor = $user->partsVendor;

        $hasVendorInput = $request->filled('vendor_name')
            || $request->filled('vendor_contact')
            || $request->filled('vendor_location')
            || $request->filled('vendor_business_hours')
            || $request->filled('vendor_tax_info');

        if (! $vendor && $hasVendorInput) {
            // Ensure required fields exist when creating new vendor record
            $request->validate([
                'vendor_name' => ['required','string','max:100'],
                'vendor_contact' => ['required','string','max:100'],
                'vendor_location' => ['required','string','max:255'],
            ]);

            $vendor = $user->partsVendor()->create([
                'name' => $request->input('vendor_name'),
                'contact' => $request->input('vendor_contact'),
                'location' => $request->input('vendor_location'),
                'business_hours' => $request->input('vendor_business_hours'),
                'tax_info' => $request->input('vendor_tax_info'),
                'is_verified' => false,
                'rating' => 0,
            ]);
        }

        if ($vendor) {
            if ($request->filled('vendor_name')) {
                $vendor->name = $request->input('vendor_name');
            }
            if ($request->filled('vendor_contact')) {
                $vendor->contact = $request->input('vendor_contact');
            }
            if ($request->filled('vendor_location')) {
                $vendor->location = $request->input('vendor_location');
            }
            if ($request->filled('vendor_business_hours')) {
                $vendor->business_hours = $request->input('vendor_business_hours');
            }
            if ($request->filled('vendor_tax_info')) {
                $vendor->tax_info = $request->input('vendor_tax_info');
            }
            $vendor->save();
        }

        return back()->with('success', 'Profile updated.');
    }
}

