<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\PartsOrder;
use App\Models\OrderItem;
use App\Models\Part;

class DashboardController extends Controller
{
    public function index()
    {
        // Simple aggregates; adjust to your schema/ownership filters as needed
        $totalOrders = PartsOrder::count();
        $pendingItems = OrderItem::whereHas('status', fn($q) => $q->where('name', 'Pending'))->count();
        $totalParts = Part::count();

        return view('vendor.dashboard', compact('totalOrders', 'pendingItems', 'totalParts'));
    }
}

