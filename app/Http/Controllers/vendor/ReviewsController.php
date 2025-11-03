<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index()
    {
        // Hook this to your real reviews table when available
        $reviews = collect(); 
        return view('vendor.reviews.index', compact('reviews'));
    }
}

