@extends('layouts.customer', ['layoutOption' => 'default'])
@section('title', 'Browse Parts')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Browse Parts</h1>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <form method="GET" class="mb-6">
            <div class="flex gap-2">
                <input type="text" name="q" value="{{ $q }}" placeholder="Search parts..."
                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
                <button class="px-4 py-2 bg-green-600 text-white rounded-md">Search</button>
                <a href="{{ route('customer.orders.cart') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md">View Cart</a>
            </div>
        </form>

        @if (session('status'))
            <div class="mb-4 rounded-md bg-green-50 p-3 text-sm text-green-700">{{ session('status') }}</div>
        @endif
        @error('cart')
            <div class="mb-4 rounded-md bg-red-50 p-3 text-sm text-red-700">{{ $message }}</div>
        @enderror

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($inventories as $inv)
                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-sm text-gray-500">{{ $inv->vendor?->name ?? 'Vendor' }}</div>
                            <div class="text-lg font-semibold">{{ $inv->part?->name ?? 'Part' }}</div>
                            <div class="text-sm text-gray-500">{{ $inv->part?->model_compatibility }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-green-700 font-bold">LKR {{ number_format($inv->price, 2) }}</div>
                            <div class="text-xs text-gray-500">In stock: {{ $inv->quantity }}</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('customer.orders.cart.add') }}" class="mt-4 flex gap-2">
                        @csrf
                        <input type="hidden" name="inventory_id" value="{{ $inv->id }}">
                        <input type="number" name="quantity" min="1" max="{{ max(1, (int)$inv->quantity) }}" value="1"
                               class="w-24 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
                        <button class="flex-1 px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Add to Cart
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full text-gray-500">No parts found.</div>
            @endforelse
        </div>

        <div class="mt-6">{{ $inventories->links() }}</div>
    </div>
</div>
@endsection