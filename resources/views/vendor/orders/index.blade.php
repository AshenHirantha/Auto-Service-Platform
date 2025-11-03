@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Orders</h2>
@endsection

@section('content')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">#</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Items</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Placed</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-4 py-3">{{ $order->id }}</td>
                        <td class="px-4 py-3">{{ $order->items_count }}</td>
                        <td class="px-4 py-3">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('vendor.orders.show', $order) }}" class="text-indigo-600">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-gray-500" colspan="4">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
