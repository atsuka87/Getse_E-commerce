<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\WarrantyClaim;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $pendingOrders = Order::where('status', 'payment_verification')->count();
        $pendingReviews = Review::where('status', 'pending')->count();
        $pendingClaims = WarrantyClaim::where('status', 'submitted')->count();

        $lowStockProducts = Product::lowStock()->with(['primaryImage', 'category'])->take(10)->get();

        $recentOrders = Order::with(['user', 'payment'])
            ->latest()
            ->take(10)
            ->get();

        $topProducts = Product::withCount(['orderItems as total_sold' => function($q) {
                $q->select(DB::raw('COALESCE(SUM(quantity), 0)'));
            }])
            ->with('primaryImage')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Revenue chart data (last 7 days)
        $revenueChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenue = Order::where('status', 'completed')
                ->whereDate('completed_at', $date)
                ->sum('total');
            $revenueChart[] = [
                'date' => $date->format('d M'),
                'revenue' => $revenue,
            ];
        }

        // Monthly revenue
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('completed_at', Carbon::now()->month)
            ->whereYear('completed_at', Carbon::now()->year)
            ->sum('total');

        $weeklyRevenue = Order::where('status', 'completed')
            ->where('completed_at', '>=', Carbon::now()->startOfWeek())
            ->sum('total');

        $dailyRevenue = Order::where('status', 'completed')
            ->whereDate('completed_at', Carbon::today())
            ->sum('total');

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalProducts', 'totalCustomers',
            'pendingOrders', 'pendingReviews', 'pendingClaims',
            'lowStockProducts', 'recentOrders', 'topProducts', 'revenueChart',
            'monthlyRevenue', 'weeklyRevenue', 'dailyRevenue'
        ));
    }
}
