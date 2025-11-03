@extends('layouts.vendor')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800">Catalog</h2>
        <a href="{{ route('vendor.catalog.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Add Part</a>
    </div>
@endsection

@section('content')
<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Image</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Manufacturer</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Vendor Price</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($parts as $part)
                    <tr>
                        <td class="px-4 py-3">
                            @if(!empty($part->thumb_url))
                                <img src="{{ $part->thumb_url }}" alt="{{ $part->name }}" class="h-12 w-12 object-cover rounded">
                            @else
                                <div class="h-12 w-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-[10px]">No Image</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $part->name }}</td>
                        <td class="px-4 py-3">{{ $part->category }}</td>
                        <td class="px-4 py-3">{{ $part->manufacturer }}</td>
                        <td class="px-4 py-3">{{ $part->vendor_price ? number_format($part->vendor_price, 2) : '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('vendor.catalog.edit', $part) }}" class="text-indigo-600">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-4 py-6 text-gray-500" colspan="8">No parts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $parts->links() }}
    </div>
</div>
@endsection
