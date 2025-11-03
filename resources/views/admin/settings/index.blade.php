@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-xl">
    <h2 class="text-xl font-bold mb-4">System Settings</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update', 1) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
            <input type="text" name="site_name" id="site_name"
                   value="{{ old('site_name', config('app.name')) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="support_email" class="block text-sm font-medium text-gray-700">Support Email</label>
            <input type="email" name="support_email" id="support_email"
                   value="{{ old('support_email', 'support@example.com') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="maintenance_mode" class="block text-sm font-medium text-gray-700">Maintenance Mode</label>
            <select name="maintenance_mode" id="maintenance_mode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="off" {{ old('maintenance_mode') == 'off' ? 'selected' : '' }}>Off</option>
                <option value="on" {{ old('maintenance_mode') == 'on' ? 'selected' : '' }}>On</option>
            </select>
        </div>

        <div>
            <label for="default_language" class="block text-sm font-medium text-gray-700">Default Language</label>
            <select name="default_language" id="default_language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="en" {{ old('default_language', config('app.locale')) == 'en' ? 'selected' : '' }}>English</option>
            <option value="si" {{ old('default_language', config('app.locale')) == 'si' ? 'selected' : '' }}>Sinhala</option>
            <option value="ta" {{ old('default_language', config('app.locale')) == 'ta' ? 'selected' : '' }}>Tamil</option>
            </select>
        </div>

        <div>
            <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
            <input type="text" name="timezone" id="timezone"
                   value="{{ old('timezone', config('app.timezone', 'UTC')) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
            <input type="text" name="contact_number" id="contact_number"
                   value="{{ old('contact_number', '+94 77 123 4567') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
