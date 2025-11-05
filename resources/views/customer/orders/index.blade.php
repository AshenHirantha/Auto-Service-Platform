@extends('layouts.customer', ['layoutOption' => 'default'])
@section('title', 'Customer Dashboard')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Customer Dashboard</h1>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Parts Orders</h2>
    </div>
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <ul class="divide-y divide-gray-200">
                @forelse($orders as $order)
                    <li>
                        <a href="{{ route('customer.orders.show', ['order' => $order->id]) }}" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-medium text-green-600 truncate">
                                        Order #{{ $order->id }}
                                    </p>
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst($order->status) }}
                                    </p>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-gray-500">
                                            Total: ${{ number_format($order->total_amount, 2) }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <p>Ordered on: {{ $order->created_at->toFormattedDateString() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-4 py-8 text-center text-gray-500">You have not placed any orders yet.</li>
                @endforelse
            </ul>
        </div>
        <div class="mt-4">{{ $orders->links() }}</div>
        <a href="{{ route('customer.orders.browse') }}" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Order Parts</a>
    </div>
</div>
@endsection