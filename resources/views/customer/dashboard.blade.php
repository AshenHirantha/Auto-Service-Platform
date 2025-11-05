@extends('layouts.customer')

@section('title', 'Customer Dashboard')

@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Customer Dashboard</h1>
@endsection

@section('content')
    <div class="px-4 py-6 sm:px-0">
        <!-- Welcome Section -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="text-4xl">??</div>
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
                            <div class="text-2xl">??</div>
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
                            <div class="text-2xl">??</div>
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
                            <div class="text-2xl">??</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Parts Orders
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ auth()->user()->partsOrders()->count() ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="text-2xl">??</div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Pending Payments
                                </dt>
                                <dd class="text-lg font-medium text-gray-900">
                                    {{ auth()->user()->partsOrders()->where('status', 'pending')->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
            <!-- Vehicle Management -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Vehicle Management</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Manage your vehicles, view service history, and add new vehicles to your account.</p>
                    </div>
                    <div class="mt-5">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            View Vehicles
                        </a>
                    </div>
                </div>
            </div>

            <!-- Service Requests -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Service Requests</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Track service statuses, schedule appointments, and manage upcoming services.</p>
                    </div>
                    <div class="mt-5">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            Manage Services
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Parts Orders -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Parts Orders</h3>
                <p class="mt-1 text-sm text-gray-500">Track recent orders and their statuses.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    @forelse(auth()->user()->partsOrders()->latest()->take(3)->get() as $order)
                        <div class="bg-gray-50 px-4 py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Order #{{ $order->id }} - {{ ucfirst($order->status) }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                Total: ${{ number_format($order->total_amount, 2) }} | Ordered on {{ $order->created_at->format('M d, Y') }}
                            </dd>
                        </div>
                    @empty
                        <div class="bg-gray-50 px-4 py-5 sm:px-6 text-sm text-gray-500">
                            You have no recent parts orders.
                        </div>
                    @endforelse
                </dl>
            </div>
            <div class="px-4 py-4 sm:px-6 bg-gray-50 text-right">
                <a href="{{ route('customer.orders.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                    View all orders
                </a>
            </div>
        </div>

        <!-- Service History -->
        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Service History</h3>
                <p class="mt-1 text-sm text-gray-500">Keep track of your recent service activities.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    @forelse(auth()->user()->serviceRequests()->latest()->take(3)->get() as $service)
                        <div class="bg-gray-50 px-4 py-5 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ $service->service_type ?? 'Service' }} - {{ ucfirst($service->status) }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                Scheduled on {{ optional($service->scheduled_at)->format('M d, Y') ?? 'N/A' }} at {{ $service->service_station->name ?? 'Service Station' }}
                            </dd>
                        </div>
                    @empty
                        <div class="bg-gray-50 px-4 py-5 sm:px-6 text-sm text-gray-500">
                            You have no recent service history.
                        </div>
                    @endforelse
                </dl>
            </div>
            <div class="px-4 py-4 sm:px-6 bg-gray-50 text-right">
                <a href="#" class="text-sm font-medium text-green-600 hover:text-green-500">
                    View all service records
                </a>
            </div>
        </div>

        <!-- Helpful Resources -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Maintenance Tips</h3>
                    <p class="mt-2 text-sm text-gray-500">Learn how to keep your vehicles running smoothly with helpful guides and tutorials.</p>
                    <div class="mt-5">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                            Explore Tips
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Service Packages</h3>
                    <p class="mt-2 text-sm text-gray-500">Discover service packages tailored to your vehicle's needs.</p>
                    <div class="mt-5">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                            View Packages
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Support Center</h3>
                    <p class="mt-2 text-sm text-gray-500">Need help? Reach out to our support team for assistance.</p>
                    <div class="mt-5">
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
