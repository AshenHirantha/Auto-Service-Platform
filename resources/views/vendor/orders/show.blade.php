@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Order #{{ $order->id }}</h2>
@endsection

@section('content')
<div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
    <div class="bg-white p-6 shadow rounded-lg">
        <div class="text-sm text-gray-500 mb-2">Placed: {{ $order->created_at->format('Y-m-d H:i') }}</div>
        <div class="border-t pt-4">
            @forelse($order->items as $item)
                <div class="flex items-center justify-between py-2 border-b last:border-b-0">
                    <div>
                        <div class="font-medium">{{ $item->part?->name ?? 'Part #'.$item->part_id }}</div>
                        <div class="text-xs text-gray-500">Status: {{ $item->status?->name ?? '—' }}</div>
                    </div>
                    <div class="text-right">
                        <div>Qty: {{ $item->quantity }}</div>
                    </div>
                </div>
            @empty
                <div class="text-gray-500">No items.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
