<?php

namespace App\Http\Controllers\customer;

use App\Models\PartsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PartsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = PartsOrder::where('user_id', Auth::id())->latest()->paginate(10);
        return view('parts-orders.index', compact('orders'));
    }
}