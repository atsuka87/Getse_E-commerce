@extends('layouts.admin')
@section('title', 'Laporan Penjualan')
@section('content')
<div class="bg-white rounded-2xl border p-6 mb-6">
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-end gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Periode</label>
                <select name="period" class="rounded-lg border-gray-300 text-sm w-40">
                    <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tanggal/Bulan Acuan</label>
                <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" class="rounded-lg border-gray-300 text-sm">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 h-[42px]">Tampilkan Laporan</button>
        </form>

        <a href="{{ route('admin.reports.export', request()->all()) }}" class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-emerald-700 h-[42px] flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Unduh Excel
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
        <p class="text-blue-600 text-sm font-medium mb-1">Total Pesanan (Selesai)</p>
        <p class="text-3xl font-bold text-blue-900">{{ $totalOrders }}</p>
        <p class="text-xs text-blue-500 mt-2">Periode: {{ $periodLabel }}</p>
    </div>
    <div class="bg-green-50 border border-green-100 rounded-2xl p-6">
        <p class="text-green-600 text-sm font-medium mb-1">Total Pendapatan</p>
        <p class="text-3xl font-bold text-green-900">{{ formatRupiah($totalRevenue) }}</p>
        <p class="text-xs text-green-500 mt-2">Periode: {{ $periodLabel }}</p>
    </div>
    <div class="bg-purple-50 border border-purple-100 rounded-2xl p-6">
        <p class="text-purple-600 text-sm font-medium mb-1">Rata-rata Nilai Pesanan</p>
        <p class="text-3xl font-bold text-purple-900">{{ formatRupiah($avgOrderValue) }}</p>
        <p class="text-xs text-purple-500 mt-2">Periode: {{ $periodLabel }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl border p-6 mb-6">
    <h3 class="font-bold text-gray-800 mb-4">Grafik Pendapatan: {{ $periodLabel }}</h3>
    <div class="relative h-80 w-full">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold text-gray-800 mb-4">5 Produk Terlaris (Unit Terjual)</h3>
        <div class="relative h-64 w-full">
            <canvas id="bestSellingChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold text-gray-800 mb-4">5 Produk Paling Jarang Dibeli (Unit Terjual)</h3>
        <div class="relative h-64 w-full">
            <canvas id="leastSellingChart"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl border overflow-hidden">
        <div class="px-6 py-4 border-b bg-green-50"><h3 class="font-bold text-green-800">Tabel 5 Produk Terlaris</h3></div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">Produk</th><th class="px-6 py-3 text-right">Terjual</th><th class="px-6 py-3 text-right">Pendapatan</th></tr></thead>
            <tbody class="divide-y">
                @forelse($bestSelling as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ Str::limit($item->product_name, 35) }}</td>
                        <td class="px-6 py-3 text-right font-bold text-green-600">{{ $item->total_sold }}</td>
                        <td class="px-6 py-3 text-right">{{ formatRupiah($item->total_revenue) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-6 py-6 text-center text-gray-500">Tidak ada data penjualan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="bg-white rounded-2xl border overflow-hidden">
        <div class="px-6 py-4 border-b bg-red-50"><h3 class="font-bold text-red-800">Tabel 5 Produk Jarang Dibeli</h3></div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">Produk</th><th class="px-6 py-3 text-right">Terjual</th><th class="px-6 py-3 text-right">Pendapatan</th></tr></thead>
            <tbody class="divide-y">
                @forelse($leastSelling as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">{{ Str::limit($item->product_name, 35) }}</td>
                        <td class="px-6 py-3 text-right font-bold text-red-600">{{ $item->total_sold }}</td>
                        <td class="px-6 py-3 text-right">{{ formatRupiah($item->total_revenue) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-6 py-6 text-center text-gray-500">Tidak ada data penjualan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="bg-white rounded-2xl border overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50"><h3 class="font-bold">Detail Transaksi: {{ $periodLabel }}</h3></div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">No. Order</th><th class="px-6 py-3 text-left">Pelanggan</th><th class="px-6 py-3 text-left">Tanggal Selesai</th><th class="px-6 py-3 text-right">Nilai Transaksi</th></tr></thead>
        <tbody class="divide-y">
            @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium"><a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">{{ $order->order_number }}</a></td>
                    <td class="px-6 py-4">{{ $order->user->name ?? $order->shipping_name }}</td>
                    <td class="px-6 py-4">{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : '-' }}</td>
                    <td class="px-6 py-4 text-right font-bold">{{ formatRupiah($order->total) }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Tidak ada transaksi selesai pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formatLabel = (label) => label.length > 20 ? label.substring(0, 20) + '...' : label;

        // --- Sales Revenue Line Chart ---
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesLabels = {!! json_encode($chartData['labels']) !!};
        const salesData = {!! json_encode($chartData['data']) !!};

        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Pendapatan',
                    data: salesData,
                    borderColor: '#2563eb', // blue-600
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        padding: 12,
                        callbacks: {
                            label: (context) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y)
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: {
                            callback: (value) => {
                                if (value >= 1000000) return 'Rp ' + (value / 1000000) + ' Jt';
                                if (value >= 1000) return 'Rp ' + (value / 1000) + ' Rb';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: { grid: { display: false, drawBorder: false } }
                }
            }
        });

        // --- Best Selling Bar Chart ---
        const bestCtx = document.getElementById('bestSellingChart').getContext('2d');
        const bestLabelsRaw = {!! json_encode($bestSelling->pluck('product_name')) !!};
        const bestDataVal = {!! json_encode($bestSelling->pluck('total_sold')) !!};

        new Chart(bestCtx, {
            type: 'bar',
            data: {
                labels: bestLabelsRaw.map(formatLabel),
                datasets: [{
                    label: 'Terjual',
                    data: bestDataVal,
                    backgroundColor: '#10b981', // green-500
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { title: (context) => bestLabelsRaw[context[0].dataIndex] }
                    }
                },
                scales: {
                    x: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { stepSize: 1 } },
                    y: { grid: { display: false } }
                }
            }
        });

        // --- Least Selling Bar Chart ---
        const leastCtx = document.getElementById('leastSellingChart').getContext('2d');
        const leastLabelsRaw = {!! json_encode($leastSelling->pluck('product_name')) !!};
        const leastDataVal = {!! json_encode($leastSelling->pluck('total_sold')) !!};

        new Chart(leastCtx, {
            type: 'bar',
            data: {
                labels: leastLabelsRaw.map(formatLabel),
                datasets: [{
                    label: 'Terjual',
                    data: leastDataVal,
                    backgroundColor: '#ef4444', // red-500
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { title: (context) => leastLabelsRaw[context[0].dataIndex] }
                    }
                },
                scales: {
                    x: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { stepSize: 1 } },
                    y: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection
