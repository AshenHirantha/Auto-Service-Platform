<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\PartsOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $orders = PartsOrder::withCount('items')->latest()->paginate(15);
        return view('vendor.orders.index', compact('orders'));
    }

    public function show(Request $request, PartsOrder $order)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $order->load(['items.part', 'items.status']);
        return view('vendor.orders.show', compact('order'));
    }
}

