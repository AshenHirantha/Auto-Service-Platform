@extends('layouts.customer', ['layoutOption' => 'default'])

@section('title', 'Customer Dashboard')
@section('header')
    <h1 class="text-3xl font-bold text-gray-900">Customer Dashboard</h1>
    
@endsection

@section('content')
<div class="bg-white shadow sm:rounded-lg mb-6">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Order Part</h3>
        <p class="mt-2 text-sm text-gray-500">Place a quick order for a part.</p>

        @if (session('status'))
            <div class="mt-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.orders.store') }}" class="mt-5 space-y-4">
            @csrf
            <div>
                <label for="part_name" class="block text-sm font-medium text-gray-700">Part Name</label>
                <input type="text" id="part_name" name="part_name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
                </div>
                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-700">Max Price (optional)</label>
                    <input type="number" step="0.01" id="max_price" name="max_price"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" />
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                          placeholder="Any additional details..."></textarea>
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Place Order
                </button>
            </div>
        </form>
    </div>
</div>
@endsection