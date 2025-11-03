@extends('layouts.admin')

@section('content')
<div x-data="{ userType: '{{ old('user_type', '') }}' }" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Create User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="user_type" class="block">User Type</label>
            <select name="user_type" id="user_type" x-model="userType" class="w-full border rounded p-2" required>
                <option value="" disabled>Select a type</option>
                @foreach(\App\Models\User::getUserTypes() as $value => $label)
                    <option value="{{ $value }}" {{ old('user_type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="is_active" class="block">Active</label>
            <select name="is_active" class="w-full border rounded p-2">
                <option value="1" {{ old('is_active', 1) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
