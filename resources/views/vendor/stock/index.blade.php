@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Stock</h2>
@endsection

@section('content')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Part</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Manufacturer</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Quantity</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Availability</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($parts as $part)
                    <tr>
                        <form method="POST" action="{{ route('vendor.stock.update', $part->id) }}">
                            @csrf @method('PUT')
                            <td class="px-4 py-3">{{ $part->name }}</td>
                            <td class="px-4 py-3">{{ $part->category }}</td>
                            <td class="px-4 py-3">{{ $part->manufacturer }}</td>
                            <td class="px-4 py-3">{{ $part->stock_qty ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $part->stock_availability ?? '-' }}</td>
                            <td class="px-4 py-3 text-right">
                                <input type="number" name="reorder_quantity" min="1" value="1" class="w-24 border rounded px-2 py-1" placeholder="Qty">
                                <button class="px-3 py-1 bg-indigo-600 text-white rounded">Re-order Stocks</button>
                            </td>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-gray-500" colspan="4">No parts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $parts->links() }}</div>
</div>
@endsection
