<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\PartsOrder;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $ordersByMonth = PartsOrder::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym'),
                DB::raw('COUNT(*) as total')
            )->groupBy('ym')->orderBy('ym', 'desc')->take(12)->get();

        $topParts = OrderItem::select('part_id', DB::raw('COUNT(*) as qty'))
            ->groupBy('part_id')->orderByDesc('qty')->take(10)->with('part')->get();

        return view('vendor.reports.index', compact('ordersByMonth','topParts'));
    }
}

