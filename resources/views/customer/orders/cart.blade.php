@extends('layouts.customer', ['layoutOption' => 'default'])
@section('title', 'Your Cart')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Your Cart</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        @if (empty($cart))
            <div class="bg-white shadow rounded-lg p-6 text-gray-600">
                Your cart is empty.
                <a class="text-green-700 underline" href="{{ route('customer.orders.browse') }}">Browse parts</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($cart as $vendorId => $group)
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="font-semibold text-gray-900 mb-3">
                            {{ $group['vendor_name'] }} (Vendor #{{ $group['vendor_id'] }})
                        </div>
                        <ul class="divide-y divide-gray-200">
                            @php $subtotal = 0; @endphp
                            @foreach ($group['items'] as $key => $item)
                                @php $line = $item['unit_price'] * $item['quantity']; $subtotal += $line; @endphp
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">{{ $item['part_name'] }}</div>
                                        <div class="text-sm text-gray-500">
                                            Qty: {{ $item['quantity'] }},
                                            Unit: ${{ number_format($item['unit_price'], 2) }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-gray-900 font-semibold">${{ number_format($line, 2) }}</div>
                                        <div class="text-xs text-gray-500">Available: {{ $item['available'] }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 flex justify-between">
                            <div class="text-gray-600">Subtotal</div>
                            <div class="font-semibold">${{ number_format($subtotal, 2) }}</div>
                        </div>
                    </div>
                @endforeach
                <form method="POST" action="{{ route('customer.orders.checkout') }}" class="flex justify-end">
                    @csrf
                    <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Send Order Request
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection