@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Reports</h2>
@endsection

@section('content')
<div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white p-6 shadow rounded-lg">
        <h3 class="font-semibold mb-3">Orders (last 12 months)</h3>
        <ul class="list-disc ml-6">
            @forelse($ordersByMonth as $row)
                <li>{{ $row->ym }} — {{ $row->total }}</li>
            @empty
                <li>No data.</li>
            @endforelse
        </ul>
    </div>

    <div class="bg-white p-6 shadow rounded-lg">
        <h3 class="font-semibold mb-3">Top Parts</h3>
        <ul class="list-disc ml-6">
            @forelse($topParts as $row)
                <li>{{ $row->part?->name ?? 'Part #'.$row->part_id }} — {{ $row->qty }}</li>
            @empty
                <li>No data.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
