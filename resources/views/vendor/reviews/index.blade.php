@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Reviews</h2>
@endsection

@section('content')
<div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 shadow rounded-lg">
        @if($reviews->isEmpty())
            <div class="text-gray-500">No reviews yet.</div>
        @else
            @foreach($reviews as $review)
                <div class="border-b py-3 last:border-b-0">
                    <div class="font-medium">{{ $review->title }}</div>
                    <div class="text-sm text-gray-500">{{ $review->created_at->format('Y-m-d') }}</div>
                    <p class="mt-1">{{ $review->body }}</p>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
