@csrf
{{-- If update, add the PUT method --}}
@if(isset($user))
    @method('PUT')
@endif

<p class="text-sm text-gray-500 mb-4">
    Fields marked with <span class="text-red-500">*</span> are required.
</p>

<div class="mb-4">
    <label for="name" class="block font-medium text-gray-700">Name: <span class="text-red-500">*</span> </label>
    <input 
        type="text" 
        id="name" 
        name="name" 
        value="{{ old('name', $user->name ?? '') }}" 
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
</div>

<div class="mb-4">
    <label for="email" class="block font-medium text-gray-700">Email: <span class="text-red-500">*</span> </label>
    <input 
        type="email" 
        id="email" 
        name="email" 
        value="{{ old('email', $user->email ?? '') }}" 
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
</div>

<div class="mb-4">
    <label for="phone" class="block font-medium text-gray-700">Phone: <span class="text-red-500">*</span> </label>
    <input 
        type="text" 
        id="phone" 
        name="phone" 
        required
        value="{{ old('phone', $user->phone ?? '') }}"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mb-4">
    <label for="password" class="block font-medium text-gray-700">Password: <span class="text-red-500">*</span> </label>
    <input 
        type="password" 
        id="password" 
        name="password" 
        @if(!isset($user)) required @endif
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
    @if(isset($user))
        <p class="text-sm text-gray-500 mt-1">Leave blank if you don’t want to change the password.</p>
    @endif
</div>

<div class="mb-4">
    <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password: <span class="text-red-500">*</span> </label>
    <input 
        type="password" 
        id="password_confirmation" 
        name="password_confirmation"
        @if(!isset($user)) required @endif
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
</div>

<div class="mb-4">
    <label for="user_type" class="block font-medium text-gray-700">Type: <span class="text-red-500">*</span> </label>
    <select 
        id="user_type" 
        name="user_type" 
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <option value="admin" {{ old('user_type', $user->user_type ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="customer" {{ old('user_type', $user->user_type ?? '') == 'customer' ? 'selected' : '' }}>Customer</option>
        <option value="service_station" {{ old('user_type', $user->user_type ?? '') == 'service_station' ? 'selected' : '' }}>Service Station</option>
        <option value="vendor" {{ old('user_type', $user->user_type ?? '') == 'vendor' ? 'selected' : '' }}>Vendor</option>
    </select>
</div>

<div class="mb-4">
    <label for="is_active" class="block font-medium text-gray-700">Active:</label>
    <select id="is_active" name="is_active" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="1" {{ old('is_active', $user->is_active ?? 1) == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ old('is_active', $user->is_active ?? 1) == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>
