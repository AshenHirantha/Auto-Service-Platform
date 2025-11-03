<?php

namespace App\Http\Controllers\customer;

use App\Models\Part;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = Part::with('vendor')->latest()->paginate(12);
        return view('parts.index', compact('parts'));
    }
}