<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Station Dashboard - Auto Service Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-white text-xl font-bold">🔧 Service Station Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-orange-100 text-sm">Welcome, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/20 text-white px-4 py-2 rounded hover:bg-white/30 transition-colors text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Status Messages -->
        @if(!auth()->user()->is_active)
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Your service station account is pending approval. You will be notified via email once your account is activated.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Dashboard Content -->
        <div class="px-4 py-6 sm:px-0">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-4xl">🔧</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Service Station Dashboard
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ auth()->user()->serviceStation->name ?? 'Your Service Station' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- Total Bookings -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📅</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Bookings
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Bookings -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">⏳</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Pending Bookings
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        0
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Services -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">✅</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Completed Services
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">⭐</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Rating
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ number_format(auth()->user()->serviceStation->rating ?? 0, 1) }}/5.0
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Manage Services -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">🛠️</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Service Catalog</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage your service offerings</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        Manage Services
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Bookings -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📅</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Bookings</h3>
                                <p class="text-sm text-gray-500 mt-1">View and manage customer bookings</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        View Bookings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Profile -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">🏢</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Business Profile</h3>
                                <p class="text-sm text-gray-500 mt-1">Update your service station information</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staff Management -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">👥</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Staff Management</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage your team and their schedules</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        Manage Staff
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Reports -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📈</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Reports</h3>
                                <p class="text-sm text-gray-500 mt-1">View service and performance analytics</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        View Reports
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Reviews -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">⭐</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Reviews</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage customer feedback</p>
                                <div class="mt-3">
                                    <button class="bg-orange-600 text-white px-4 py-2 rounded text-sm hover:bg-orange-700 transition-colors">
                                        View Reviews
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filament Integration Notice -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Note:</strong> This is a temporary dashboard. The full service station management system will be available through Filament Admin Panel once it's configured.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>