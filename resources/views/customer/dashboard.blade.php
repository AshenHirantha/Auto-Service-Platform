<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Dashboard - Auto Service Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-white text-xl font-bold">👤 Customer Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-green-100 text-sm">Welcome, {{ auth()->user()->name }}</span>
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
        <!-- Dashboard Content -->
        <div class="px-4 py-6 sm:px-0">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-4xl">🚗</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Welcome to Your Dashboard
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    Manage your vehicles and services
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- My Vehicles -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🚙</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        My Vehicles
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ auth()->user()->vehicles->count() ?? 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Services -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🔧</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Active Services
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ auth()->user()->serviceRequests()->where('service_requests.status','active')->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parts Orders -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📦</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Parts Orders
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ auth()->user()->partsOrders->count() ?? 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Services -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🛠️</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Services
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ auth()->user()->serviceRequests->count() ?? 0 }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Add Vehicle -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">🚗</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">My Vehicles</h3>
                                <p class="text-sm text-gray-500 mt-1">Add and manage your vehicles</p>
                                <div class="mt-3">
                                    <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                        Add Vehicle
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Service -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📅</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Book Service</h3>
                                <p class="text-sm text-gray-500 mt-1">Schedule maintenance or repairs</p>
                                <div class="mt-3">
                                    <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Parts -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">🛒</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Order Parts</h3>
                                <p class="text-sm text-gray-500 mt-1">Browse and order vehicle parts</p>
                                <div class="mt-3">
                                    <a href="{{ route('parts-orders.index') }}">
                                        <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                            Shop Parts
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service History -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📋</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Service History</h3>
                                <p class="text-sm text-gray-500 mt-1">View past services and records</p>
                                <div class="mt-3">
                                    <a href="{{ route('parts-orders.index') }}">
                                        <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                            View History
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expert Consultation -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">👨‍🔧</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Expert Help</h3>
                                <p class="text-sm text-gray-500 mt-1">Get advice from automotive experts</p>
                                <div class="mt-3">
                                    <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                        Book Consultation
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">⚙️</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Account Settings</h3>
                                <p class="text-sm text-gray-500 mt-1">Update your profile and preferences</p>
                                <div class="mt-3">
                                    <button class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition-colors">
                                        Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="mt-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                        <div class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">📊</div>
                            <p>No recent activity to display</p>
                            <p class="text-sm mt-1">Start by adding a vehicle or booking a service</p>
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>