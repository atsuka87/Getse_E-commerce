@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan atau pelanggan..." class="rounded-lg border-gray-300 text-sm w-64">
            <select name="status" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="awaiting_payment" {{ request('status') == 'awaiting_payment' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="payment_verification" {{ request('status') == 'payment_verification' ? 'selected' : '' }}>Verifikasi Pembayaran</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Terkirim</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">No. Pesanan</th><th class="px-6 py-3 text-left">Pelanggan</th><th class="px-6 py-3 text-right">Total</th><th class="px-6 py-3 text-center">Status</th><th class="px-6 py-3 text-left">Tanggal</th><th class="px-6 py-3 text-center">Aksi</th></tr></thead>
            <tbody class="divide-y">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $order->order_number }}</td>
                    <td class="px-6 py-4">
                        <p class="font-semibold text-gray-800">{{ $order->user->name ?? $order->shipping_name }}</p>
                    </td>
                    <td class="px-6 py-4 text-right font-bold text-gray-900">{{ formatRupiah($order->total) }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ match($order->status_color) {
                                'green' => 'bg-green-100 text-green-700',
                                'red' => 'bg-red-100 text-red-700',
                                'blue' => 'bg-blue-100 text-blue-700',
                                'yellow' => 'bg-yellow-100 text-yellow-700',
                                'orange' => 'bg-orange-100 text-orange-700',
                                'purple' => 'bg-purple-100 text-purple-700',
                                'indigo' => 'bg-indigo-100 text-indigo-700',
                                'teal' => 'bg-teal-100 text-teal-700',
                                default => 'bg-gray-100 text-gray-700'
                            } }}">{{ $order->status_label }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 font-medium hover:text-blue-800">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
@endsection
