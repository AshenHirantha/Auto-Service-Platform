@extends('layouts.customer', ['layoutOption' => 'default'])

@section('title', 'Order Details')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
@endsection

@section('content')
<div class="bg-white shadow sm:rounded-lg mb-6">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Order Details</h3>
        <p class="mt-2 text-sm text-gray-500">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
        <p class="mt-2 text-sm text-gray-500">Total: ${{ number_format($order->total_amount, 2) }}</p>
        <p class="mt-2 text-sm text-gray-500">Ordered on: {{ $order->created_at->toFormattedDateString() }}</p>
        <p class="mt-2 text-sm text-gray-500">Shipping Address: {{ $order->shipping_address ?? 'N/A' }}</p>

        <div class="mt-6">
            <h4 class="text-md font-semibold mb-2">Items</h4>
            <ul class="divide-y divide-gray-200">
                @foreach ($order->items as $item)
                    <li class="py-2 flex justify-between items-center">
                        <div>
                            <div class="font-medium">{{ $item->part->name ?? 'Part' }}</div>
                            <div class="text-sm text-gray-500">Qty: {{ $item->quantity }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-gray-900 font-semibold">${{ number_format($item->subtotal, 2) }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="pt-4">
            <a href="{{ route('customer.orders.index') }}" class="inline-flex items-center px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Back to Orders</a>
        </div>
    </div>
</div>
@endsection