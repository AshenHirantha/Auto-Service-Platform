<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceStation;
use App\Models\PartsVendor;
use App\Models\PartsOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $serviceStations = ServiceStation::count();
        $vendors = PartsVendor::count();
        $totalOrders = PartsOrder::count();
        $pendingOrders = PartsOrder::where('status', 'pending')->count();
        $totalRevenue = PartsOrder::where('status', 'completed')->sum('total_amount');
        $activeUsers = User::where('updated_at', '>=', now()->subDays(30))->count();
        $averageOrderValue = PartsOrder::where('status', 'completed')->avg('total_amount');

        $recentUsers = User::orderBy('created_at', 'desc')->take(10)->get();

        // User Growth (last 12 months)
        $userGrowthLabels = collect(range(0, 11))->map(function ($i) {
            return now()->subMonths($i)->format('M Y');
        })->reverse()->values();
        $userGrowthData = collect(range(0, 11))->map(function ($i) {
            return User::whereBetween('created_at', [
                now()->subMonths($i+1)->startOfMonth(),
                now()->subMonths($i)->endOfMonth()
            ])->count();
        })->reverse()->values();

        // Revenue Chart (last 12 months)
        $revenueLabels = $userGrowthLabels;
        $revenueData = collect(range(0, 11))->map(function ($i) {
            return PartsOrder::where('status', 'completed')
                ->whereBetween('created_at', [
                    now()->subMonths($i+1)->startOfMonth(),
                    now()->subMonths($i)->endOfMonth()
                ])->sum('total_amount');
        })->reverse()->values();

        // Order Status Breakdown
        $orderStatusLabels = ['Pending', 'Processing', 'Completed', 'Cancelled'];
        $orderStatusData = [
            PartsOrder::where('status', 'pending')->count(),
            PartsOrder::where('status', 'processing')->count(),
            PartsOrder::where('status', 'completed')->count(),
            PartsOrder::where('status', 'cancelled')->count(),
        ];

        return view('admin.reports.index', compact(
            'totalUsers',
            'serviceStations',
            'vendors',
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'activeUsers',
            'averageOrderValue',
            'recentUsers',
            'userGrowthLabels',
            'userGrowthData',
            'revenueLabels',
            'revenueData',
            'orderStatusLabels',
            'orderStatusData'
        ));
    }
}
