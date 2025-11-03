@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Profile</h2>
@endsection

@section('content')
<div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('vendor.profile.update') }}" class="bg-white p-6 shadow rounded-lg space-y-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2" required>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Business Name</label>
            <input type="text" name="vendor_name" value="{{ old('vendor_name', optional($user->partsVendor)->name) }}" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('vendor_name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Business Contact</label>
            <input type="text" name="vendor_contact" value="{{ old('vendor_contact', optional($user->partsVendor)->contact) }}" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('vendor_contact')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Business Address</label>
            <input type="text" name="vendor_location" value="{{ old('vendor_location', optional($user->partsVendor)->location) }}" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('vendor_location')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Business Hours</label>
            <input type="text" name="vendor_business_hours" value="{{ old('vendor_business_hours', optional($user->partsVendor)->business_hours) }}" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('vendor_business_hours')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="block">Business Registration Number</label>
            <input type="text" name="vendor_tax_info" value="{{ old('vendor_tax_info', optional($user->partsVendor)->tax_info) }}" class="w-full border rounded p-2">
            <x-input-error :messages="$errors->get('vendor_tax_info')" class="mt-2" />
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
