<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
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
                $chartData['labels'][] = $currentDate->translatedFormat('l');
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

        // Product Statistics
        $itemsQuery = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
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

        return view('pemilik.dashboard', compact(
            'totalOrders', 'totalRevenue', 'avgOrderValue',
            'period', 'date', 'periodLabel', 'chartData', 'bestSelling', 'leastSelling', 'orders'
        ));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));

        $query = Order::where('status', 'completed')->with('items', 'user', 'payment');

        if ($period === 'daily') {
            $query->whereDate('completed_at', $date);
            $filename = "laporan_penjualan_harian_{$date}.csv";
        } elseif ($period === 'weekly') {
            $startOfWeek = Carbon::parse($date)->startOfWeek();
            $endOfWeek = Carbon::parse($date)->endOfWeek();
            $query->whereBetween('completed_at', [$startOfWeek, $endOfWeek]);
            $filename = "laporan_penjualan_mingguan_{$startOfWeek->format('Y-m-d')}.csv";
        } else {
            $query->whereMonth('completed_at', Carbon::parse($date)->month)
                  ->whereYear('completed_at', Carbon::parse($date)->year);
            $filename = "laporan_penjualan_bulanan_" . Carbon::parse($date)->format('Y-m') . ".csv";
        }

        $orders = $query->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID Pesanan', 'Tanggal Selesai', 'Nama Pelanggan', 'Total Pembayaran', 'Metode Pembayaran', 'Item');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $itemsList = $order->items->map(function ($item) {
                    return $item->product_name . ' (' . $item->quantity . 'x)';
                })->implode(', ');

                $row['ID Pesanan'] = $order->id;
                $row['Tanggal Selesai'] = Carbon::parse($order->completed_at)->format('d-m-Y H:i');
                $row['Nama Pelanggan'] = $order->user->name ?? '-';
                $row['Total Pembayaran'] = $order->total;
                $row['Metode Pembayaran'] = $order->payment->payment_method ?? '-';
                $row['Item'] = $itemsList;

                fputcsv($file, array($row['ID Pesanan'], $row['Tanggal Selesai'], $row['Nama Pelanggan'], $row['Total Pembayaran'], $row['Metode Pembayaran'], $row['Item']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
