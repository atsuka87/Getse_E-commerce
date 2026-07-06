@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">{{ formatRupiah($totalRevenue) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCustomers }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center"><svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
            </div>
        </div>
    </div>

    {{-- Revenue Period & Alerts --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-1">Revenue Hari Ini</h3>
            <p class="text-2xl font-bold text-green-600">{{ formatRupiah($dailyRevenue) }}</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-1">Revenue Minggu Ini</h3>
            <p class="text-2xl font-bold text-blue-600">{{ formatRupiah($weeklyRevenue) }}</p>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-700 mb-1">Revenue Bulan Ini</h3>
            <p class="text-2xl font-bold text-purple-600">{{ formatRupiah($monthlyRevenue) }}</p>
        </div>
    </div>

    {{-- Pending Alerts --}}
    @if($pendingOrders > 0 || $pendingReviews > 0 || $pendingClaims > 0)
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            @if($pendingOrders > 0)
                <a href="{{ route('admin.orders.index', ['status' => 'payment_verification']) }}" class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-center gap-3 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center"><span class="text-yellow-600 font-bold">{{ $pendingOrders }}</span></div>
                    <span class="text-sm font-medium text-yellow-800">Pembayaran menunggu verifikasi</span>
                </a>
            @endif
            @if($pendingReviews > 0)
                <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center gap-3 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center"><span class="text-blue-600 font-bold">{{ $pendingReviews }}</span></div>
                    <span class="text-sm font-medium text-blue-800">Review menunggu moderasi</span>
                </a>
            @endif
            @if($pendingClaims > 0)
                <a href="{{ route('admin.warranty-claims.index', ['status' => 'submitted']) }}" class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center gap-3 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center"><span class="text-red-600 font-bold">{{ $pendingClaims }}</span></div>
                    <span class="text-sm font-medium text-red-800">Klaim garansi baru</span>
                </a>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Orders --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-gray-900">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua →</a>
            </div>
            <div class="space-y-3">
                @foreach($recentOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="flex items-center justify-between py-2 border-b last:border-0 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition">
                        <div>
                            <span class="text-sm font-semibold text-gray-800">{{ $order->order_number }}</span>
                            <span class="text-xs text-gray-400 ml-2">{{ $order->user->name ?? '-' }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900">{{ formatRupiah($order->total) }}</span>
                            <div class="text-xs text-gray-400">{{ $order->status_label }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Top Products --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Produk Terlaris</h2>
            <div class="space-y-3">
                @foreach($topProducts as $i => $product)
                    <div class="flex items-center gap-3 py-2 border-b last:border-0">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-purple-500 text-white flex items-center justify-center font-bold text-sm">{{ $i + 1 }}</span>
                        <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</p>
                            <p class="text-xs text-gray-400">{{ $product->total_sold ?? 0 }} terjual</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Low Stock Products --}}
    @if($lowStockProducts->count() > 0)
        <div class="mt-8 bg-orange-50 rounded-2xl border border-orange-200 p-6">
            <h2 class="font-bold text-orange-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                Produk Hampir Habis
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($lowStockProducts as $product)
                    <div class="bg-white rounded-xl p-3 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-800">{{ $product->name }}</p>
                            <p class="text-xs text-orange-600 font-medium">Sisa {{ $product->stock }} unit</p>
                        </div>
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Edit</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
