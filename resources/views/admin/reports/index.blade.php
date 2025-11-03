@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">System Reports</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Total Users</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Service Stations</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $serviceStations }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Vendors</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $vendors }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Total Orders</h3>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Pending Orders</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Total Revenue</h3>
            <p class="text-2xl font-bold text-green-700">${{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Active Users (Last 30 Days)</h3>
            <p class="text-2xl font-bold text-blue-700">{{ $activeUsers }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600">Average Order Value</h3>
            <p class="text-2xl font-bold text-purple-700">${{ number_format($averageOrderValue, 2) }}</p>
        </div>
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600 mb-2">User Growth (Last 12 Months)</h3>
            <canvas id="userGrowthChart" height="120"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600 mb-2">Monthly Revenue</h3>
            <canvas id="revenueChart" height="120"></canvas>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-sm font-medium text-gray-600 mb-2">Order Status Breakdown</h3>
            <canvas id="orderStatusChart" height="120"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // User Growth Chart
        new Chart(document.getElementById('userGrowthChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($userGrowthLabels),
                datasets: [{
                    label: 'Users',
                    data: @json($userGrowthData),
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Revenue Chart
        new Chart(document.getElementById('revenueChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($revenueLabels),
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenueData),
                    backgroundColor: '#10b981'
                }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        // Order Status Chart
        new Chart(document.getElementById('orderStatusChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($orderStatusLabels),
                datasets: [{
                    label: 'Orders',
                    data: @json($orderStatusData),
                    backgroundColor: ['#f59e42', '#6366f1', '#10b981', '#ef4444']
                }]
            },
            options: { responsive: true }
        });
    </script>
</div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2">Recent Registrations</h3>
        <ul class="divide-y divide-gray-200">
            @foreach($recentUsers as $user)
                <li class="py-2 flex justify-between">
                    <span>{{ $user->name }} ({{ $user->email }})</span>
                    <span class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</span>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
