<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));

        $query = Order::where('status', 'completed');

        if ($period === 'daily') {
            $query->whereDate('completed_at', $date);
            $periodLabel = Carbon::parse($date)->format('d F Y');
        } elseif ($period === 'weekly') {
            $startOfWeek = Carbon::parse($date)->startOfWeek();
            $endOfWeek = Carbon::parse($date)->endOfWeek();
            $query->whereBetween('completed_at', [$startOfWeek, $endOfWeek]);
            $periodLabel = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M Y');
        } else {
            $query->whereMonth('completed_at', Carbon::parse($date)->month)
                  ->whereYear('completed_at', Carbon::parse($date)->year);
            $periodLabel = Carbon::parse($date)->format('F Y');
        }

        $totalOrders = (clone $query)->count();
        $totalRevenue = (clone $query)->sum('total');
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Prepare chart data for revenue
        $ordersForChart = (clone $query)->select('total', 'completed_at')->get();
        $chartData = ['labels' => [], 'data' => []];

        if ($period === 'daily') {
            $grouped = $ordersForChart->groupBy(function($order) {
                return Carbon::parse($order->completed_at)->format('H');
            });
            for ($i = 0; $i < 24; $i++) {
                $hour = sprintf('%02d', $i);
                $chartData['labels'][] = $hour . ':00';
                $chartData['data'][] = isset($grouped[$hour]) ? $grouped[$hour]->sum('total') : 0;
            }
        } elseif ($period === 'weekly') {
            $grouped = $ordersForChart->groupBy(function($order) {
                return Carbon::parse($order->completed_at)->format('Y-m-d');
            });
            $currentDate = clone $startOfWeek;
            while ($currentDate <= $endOfWeek) {
                $dateStr = $currentDate->format('Y-m-d');
                $chartData['labels'][] = $currentDate->translatedFormat('l'); // translated weekday
                $chartData['data'][] = isset($grouped[$dateStr]) ? $grouped[$dateStr]->sum('total') : 0;
                $currentDate->addDay();
            }
        } else {
            $grouped = $ordersForChart->groupBy(function($order) {
                return Carbon::parse($order->completed_at)->format('Y-m-d');
            });
            $startOfMonth = Carbon::parse($date)->startOfMonth();
            $endOfMonth = Carbon::parse($date)->endOfMonth();
            $currentDate = clone $startOfMonth;
            while ($currentDate <= $endOfMonth) {
                $dateStr = $currentDate->format('Y-m-d');
                $chartData['labels'][] = $currentDate->format('d');
                $chartData['data'][] = isset($grouped[$dateStr]) ? $grouped[$dateStr]->sum('total') : 0;
                $currentDate->addDay();
            }
        }

        // Product Statistics (Best and Least Selling)
        $itemsQuery = \App\Models\OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->selectRaw('order_items.product_name, SUM(order_items.quantity) as total_sold, SUM(order_items.subtotal) as total_revenue')
            ->groupBy('order_items.product_id', 'order_items.product_name');

        if ($period === 'daily') {
            $itemsQuery->whereDate('orders.completed_at', $date);
        } elseif ($period === 'weekly') {
            $itemsQuery->whereBetween('orders.completed_at', [$startOfWeek, $endOfWeek]);
        } else {
            $itemsQuery->whereMonth('orders.completed_at', Carbon::parse($date)->month)
                       ->whereYear('orders.completed_at', Carbon::parse($date)->year);
        }

        $productStats = $itemsQuery->get();

        $bestSelling = $productStats->sortByDesc('total_sold')->take(5)->values();
        $leastSelling = $productStats->sortBy('total_sold')->take(5)->values();

        $orders = $query->with(['user', 'items'])->latest('completed_at')->paginate(20);

        return view('admin.reports.index', compact(
            'orders', 'totalOrders', 'totalRevenue', 'avgOrderValue',
            'period', 'date', 'periodLabel', 'chartData', 'bestSelling', 'leastSelling'
        ));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));

        $query = Order::where('status', 'completed')->with(['user', 'items']);

        if ($period === 'daily') {
            $query->whereDate('completed_at', $date);
            $filename = 'Laporan_Penjualan_Harian_' . $date . '.csv';
        } elseif ($period === 'weekly') {
            $startOfWeek = Carbon::parse($date)->startOfWeek();
            $endOfWeek = Carbon::parse($date)->endOfWeek();
            $query->whereBetween('completed_at', [$startOfWeek, $endOfWeek]);
            $filename = 'Laporan_Penjualan_Mingguan_' . $startOfWeek->format('Ymd') . '-' . $endOfWeek->format('Ymd') . '.csv';
        } else {
            $query->whereMonth('completed_at', Carbon::parse($date)->month)
                  ->whereYear('completed_at', Carbon::parse($date)->year);
            $filename = 'Laporan_Penjualan_Bulanan_' . Carbon::parse($date)->format('Y_m') . '.csv';
        }

        $orders = $query->latest('completed_at')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($orders) {
            $file = fopen('php://output', 'w');
            
            // Add BOM to fix UTF-8 in Excel
            fputs($file, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            fputcsv($file, [
                'ID Pesanan', 'Tanggal Selesai', 'Nama Pelanggan', 'Email', 
                'Total Item', 'Total Pendapatan (Rp)', 'Metode Pembayaran', 'Produk yang Dibeli'
            ]);

            foreach ($orders as $order) {
                $productNames = $order->items->map(function($item) {
                    return $item->product_name . ' (' . $item->quantity . 'x)';
                })->implode(', ');

                fputcsv($file, [
                    $order->order_number,
                    Carbon::parse($order->completed_at)->format('d-m-Y H:i'),
                    $order->user->name ?? 'User Terhapus',
                    $order->user->email ?? '-',
                    $order->items->sum('quantity'),
                    $order->total,
                    strtoupper($order->payment_method),
                    $productNames
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
