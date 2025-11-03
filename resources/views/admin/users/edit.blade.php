@extends('layouts.admin')

@section('content')
<div x-data="{ userType: '{{ old('user_type', $user->user_type) }}' }" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="user_type" class="block">User Type</label>
            <select name="user_type" id="user_type" x-model="userType" class="w-full border rounded p-2" required>
                @foreach(\App\Models\User::getUserTypes() as $value => $label)
                    <option value="{{ $value }}" {{ old('user_type', $user->user_type) === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="is_active" class="block">Active</label>
            <select name="is_active" class="w-full border rounded p-2">
                <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $user->is_active) === false ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
