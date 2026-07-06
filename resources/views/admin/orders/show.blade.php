@extends('layouts.admin')
@section('title', 'Detail Pesanan: ' . $order->order_number)
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl border p-6">
            <h3 class="font-bold mb-4">Item Pesanan</h3>
            @foreach($order->items as $item)
                <div class="flex items-center justify-between py-2 border-b last:border-0">
                    <div>
                        <p class="font-medium">{{ $item->product_name }}</p>
                        <p class="text-sm text-gray-500">{{ formatRupiah($item->price) }} x {{ $item->quantity }}</p>
                    </div>
                    <span class="font-bold">{{ formatRupiah($item->subtotal) }}</span>
                </div>
            @endforeach
            <div class="mt-4 pt-4 border-t flex justify-between text-lg font-bold">
                <span>Total</span><span>{{ formatRupiah($order->total) }}</span>
            </div>
        </div>

        @if($order->payment && $order->status === 'payment_verification')
            <div class="bg-yellow-50 rounded-2xl border border-yellow-200 p-6">
                <h3 class="font-bold text-yellow-800 mb-4">Verifikasi Pembayaran</h3>
                <div class="flex gap-4 mb-4 overflow-x-auto">
                    @foreach($order->payment->proofs as $proof)
                        <a href="{{ asset('storage/' . $proof->image_path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $proof->image_path) }}" class="h-32 rounded-lg border object-cover">
                        </a>
                    @endforeach
                </div>
                <form action="{{ route('admin.orders.verify-payment', $order) }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <textarea name="admin_notes" rows="2" class="w-full rounded-lg border-gray-300 text-sm" placeholder="Catatan Admin (opsional)"></textarea>
                    <div class="flex gap-3">
                        <button type="submit" name="action" value="reject" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700">Tolak Pembayaran</button>
                        <button type="submit" name="action" value="verify" class="flex-1 bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700">Verifikasi Pembayaran</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl border p-6">
            <h3 class="font-bold mb-4">Update Status</h3>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300" x-data x-on:change="$refs.shipping_info.style.display = $event.target.value === 'shipped' ? 'block' : 'none'">
                        @php
                            $statusLabels = [
                                'pending' => 'Menunggu',
                                'awaiting_payment' => 'Menunggu Pembayaran',
                                'payment_verification' => 'Verifikasi Pembayaran',
                                'processing' => 'Sedang Diproses',
                                'shipped' => 'Dikirim',
                                'delivered' => 'Pesanan Diterima',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                'refunded' => 'Dikembalikan (Refund)'
                            ];
                        @endphp
                        @foreach(['pending', 'awaiting_payment', 'payment_verification', 'processing', 'shipped', 'delivered', 'completed', 'cancelled', 'refunded'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ $statusLabels[$s] }}</option>
                        @endforeach
                    </select>
                </div>
                <div x-ref="shipping_info" style="display: {{ $order->status === 'shipped' ? 'block' : 'none' }};">
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Kurir</label>
                        <input type="text" name="shipping_courier" value="{{ old('shipping_courier', $order->shipping_courier) }}" class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">No. Resi</label>
                        <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" class="w-full rounded-lg border-gray-300">
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700">Update Status</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl border p-6">
            <h3 class="font-bold mb-3">Info Pelanggan & Pengiriman</h3>
            <div class="text-sm space-y-2">
                <p><span class="text-gray-500">Nama:</span> {{ $order->shipping_name }}</p>
                <p><span class="text-gray-500">Telp:</span> {{ $order->shipping_phone }}</p>
                <p><span class="text-gray-500">Alamat:</span> {{ $order->shipping_address }}</p>
                <p><span class="text-gray-500">Kota:</span> {{ $order->shipping_city }}</p>
                <p><span class="text-gray-500">Provinsi:</span> {{ $order->shipping_province }}</p>
                <p><span class="text-gray-500">Kode Pos:</span> {{ $order->shipping_postal_code }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
