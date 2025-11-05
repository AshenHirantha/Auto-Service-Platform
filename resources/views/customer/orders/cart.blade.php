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
                                            Qty: 
                                            <form method="POST" action="{{ route('customer.orders.updateQuantity') }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="vendor_id" value="{{ $group['vendor_id'] }}">
                                                <input type="hidden" name="item_key" value="{{ $key }}">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['available'] }}" class="w-16 px-1 py-0.5 border rounded text-sm">
                                                <button type="submit" class="ml-2 px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">Update</button>
                                            </form>
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

                        <div class="mt-3 flex justify-between items-center">
                            <div class="text-gray-600">Shipping</div>
                            <form method="POST" action="{{ route('customer.orders.updateShippingAddress') }}" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="vendor_id" value="{{ $group['vendor_id'] }}">
                                <input
                                    type="text"
                                    name="shipping_address"
                                    value="{{ old('shipping_address', $group['shipping_address'] ?? '') }}"
                                    placeholder="Enter shipping address"
                                    class="w-64 px-2 py-1 border rounded text-sm @error('shipping_address') border-red-500 @enderror"
                                    required
                                    id="shipping-address-{{ $group['vendor_id'] }}"
                                >
                                @if ($errors->has('shipping_address'))
                                    <span class="text-xs text-red-600">{{ $errors->first('shipping_address') }}</span>
                                @endif
                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                    Update
                                </button>
                            </form>
                        </div>
                        @if (!empty($group['shipping_address']))
                            <div class="mt-1 text-sm text-gray-700">
                                <span class="font-medium">Current address:</span>
                                {{ $group['shipping_address'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('customer.orders.browse') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Back</a>
                    <form method="POST" action="{{ route('customer.orders.clearCart') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Clear Cart</button>
                    </form>
                    <form method="POST" action="{{ route('customer.orders.checkout') }}" class="flex justify-end">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Send Order Request
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection