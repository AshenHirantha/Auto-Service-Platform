<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vendor Dashboard - Auto Service Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-white text-xl font-bold">🛠️ Vendor Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-purple-100 text-sm">Welcome, {{ auth()->user()->name }}</span>
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
                            Your vendor account is pending approval. You will be notified via email once your account is activated.
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
                            <div class="text-4xl">🛠️</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Your Dashboard
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ auth()->user()->partsVendor->name ?? '' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- Total Orders -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📦</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Orders
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ $totalOrders }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">⏳</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Pending Orders
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ $pendingItems }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Items -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">📋</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Inventory Items
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ $totalParts }}
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
                                        {{ number_format(optional(auth()->user()->partsVendor)->rating ?? 0, 1) }}/5.0
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Manage Parts Catalog -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">🔧</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Parts Catalog</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage your parts inventory and catalog</p>
                                <div class="mt-3">
                                    <a href="{{ route('vendor.catalog.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm bg-purple-700 transition-colors inline-block"> Manage Catalog</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Process Orders -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📦</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Orders</h3>
                                <p class="text-sm text-gray-500 mt-1">Process and fulfill customer orders</p>
                                <div class="mt-3">
                                    <a href="{{ route('vendor.orders.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm hover:bg-purple-700 transition-colors inline-block"> View Orders</a>
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
                                <p class="text-sm text-gray-500 mt-1">Update your business information</p>
                                <div class="mt-3">
                                    <a href="{{ route('vendor.profile.edit') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm bg-purple-700 transition-colors inline-block"> Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Management -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📊</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Inventory</h3>
                                <p class="text-sm text-gray-500 mt-1">Track stock levels and reorders</p>
                                <div class="mt-3">
                                    <a href="{{ route('vendor.stock.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm bg-purple-700 transition-colors inline-block"> View Stock</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Reports -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-3xl">📈</div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Reports</h3>
                                <p class="text-sm text-gray-500 mt-1">View sales and performance analytics</p>
                                <div class="mt-3">
                                    <a href="{{ route('vendor.reports.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm bg-purple-700 transition-colors inline-block">View Reports</a>
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
                                    <a href="{{ route('vendor.reviews.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded text-sm bg-purple-700 transition-colors inline-block"> View Reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
