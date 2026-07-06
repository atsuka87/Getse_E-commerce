@extends('layouts.app')
@section('title', 'Detail Pesanan ' . $order->order_number)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:text-blue-700">← Kembali ke Pesanan</a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $order->order_number }}</h1>
        </div>
        <span class="px-4 py-2 rounded-full text-sm font-semibold
            {{ match($order->status_color) {
                'green' => 'bg-green-100 text-green-700',
                'red' => 'bg-red-100 text-red-700',
                'blue' => 'bg-blue-100 text-blue-700',
                'yellow' => 'bg-yellow-100 text-yellow-700',
                'orange' => 'bg-orange-100 text-orange-700',
                default => 'bg-gray-100 text-gray-700'
            } }}">{{ $order->status_label }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Items --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="font-bold text-gray-900 mb-4">Produk Dipesan</h2>
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 py-3 border-b last:border-0">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($item->product && $item->product->primaryImage)
                                <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-500">{{ formatRupiah($item->price) }} x {{ $item->quantity }}</p>
                        </div>
                        <span class="font-bold">{{ formatRupiah($item->subtotal) }}</span>
                    </div>
                @endforeach
                <div class="border-t mt-4 pt-4">
                    <div class="flex justify-between text-lg font-bold"><span>Total</span><span>{{ formatRupiah($order->total) }}</span></div>
                </div>
            </div>

            {{-- Payment Proof Upload --}}
            @if(in_array($order->status, ['awaiting_payment', 'payment_verification']))
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-4">Upload Bukti Pembayaran</h2>

                    @if($order->payment && $order->payment->method === 'bank_transfer')
                        <div class="bg-blue-50 rounded-xl p-4 mb-4 text-sm">
                            <p class="font-semibold text-blue-800">Transfer ke:</p>
                            <p class="text-blue-700">{{ socialSetting('bank_name') }} - {{ socialSetting('bank_account_number') }}</p>
                            <p class="text-blue-700">a/n {{ socialSetting('bank_account_name') }}</p>
                            <p class="text-blue-800 font-bold mt-1">Total: {{ formatRupiah($order->total) }}</p>
                        </div>
                    @endif

                    @if($order->payment && $order->payment->method === 'qris')
                        <div class="bg-green-50 rounded-xl p-4 mb-4 text-sm">
                            <p class="font-semibold text-green-800 mb-3">Scan QRIS untuk membayar:</p>
                            @php $qrisImage = socialSetting('qris_image'); @endphp
                            @if($qrisImage)
                                <div class="flex justify-center mb-3">
                                    <img src="{{ asset('storage/' . $qrisImage) }}"
                                         alt="QRIS Toko"
                                         class="max-w-xs w-full border-2 border-green-200 rounded-xl p-2 bg-white shadow-sm">
                                </div>
                            @else
                                <p class="text-green-700 italic">Gambar QRIS belum dikonfigurasi oleh admin.</p>
                            @endif
                            <p class="text-green-800 font-bold text-center mt-2">Total: {{ formatRupiah($order->total) }}</p>
                            <p class="text-green-700 text-center text-xs mt-1">Setelah membayar, upload bukti screenshot di bawah.</p>
                        </div>
                    @endif

                    @if($order->payment && $order->payment->proofs->count() > 0)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 mb-2">Bukti yang sudah diupload:</p>
                            <div class="flex gap-2">
                                @foreach($order->payment->proofs as $proof)
                                    <img src="{{ asset('storage/' . $proof->image_path) }}" class="w-24 h-24 rounded-lg object-cover border" alt="Bukti pembayaran">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('orders.upload-proof', $order) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="proof_image" accept="image/*" required class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('proof_image')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="notes" rows="2" placeholder="Catatan (opsional)" class="w-full rounded-lg border-gray-300 text-sm"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-semibold transition">Upload Bukti</button>
                    </form>
                </div>
            @endif

            {{-- Review Section (for completed orders) --}}
            @if($order->status === 'completed')
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-4">Beri Ulasan</h2>
                    @foreach($order->items as $item)
                        @php
                            $existingReview = $order->reviews->where('product_id', $item->product_id)->first();
                        @endphp
                        @if(!$existingReview)
                            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="border-b pb-4 mb-4 last:border-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <p class="font-medium text-gray-800 mb-2">{{ $item->product_name }}</p>
                                <div class="flex items-center gap-2 mb-3" x-data="{ rating: 5 }">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" @click="rating = {{ $i }}">
                                            <svg class="w-6 h-6 transition" :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-200'" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        </button>
                                    @endfor
                                    <input type="hidden" name="rating" x-model="rating">
                                </div>
                                <textarea name="comment" rows="2" placeholder="Tulis ulasan Anda..." class="w-full rounded-lg border-gray-300 text-sm mb-2"></textarea>
                                <input type="file" name="images[]" multiple accept="image/*" class="text-sm mb-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">Kirim Review</button>
                            </form>
                        @else
                            <p class="text-sm text-green-600 mb-2">✓ Review untuk {{ $item->product_name }} sudah dikirim</p>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sidebar Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="font-bold text-gray-900 mb-3">Pengiriman</h2>
                <div class="text-sm text-gray-600 space-y-1">
                    <p class="font-semibold text-gray-800">{{ $order->shipping_name }}</p>
                    <p>{{ $order->shipping_phone }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}</p>
                </div>
                @if($order->tracking_number)
                    <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <p class="text-xs text-blue-600 font-medium mb-1">Kurir Pengiriman: {{ strtoupper($order->shipping_courier) }}</p>
                        <div class="flex items-center justify-between bg-white rounded-lg p-2 border border-blue-100 mb-3">
                            <span class="text-sm font-bold text-gray-800 tracking-wider">{{ $order->tracking_number }}</span>
                            <button onclick="navigator.clipboard.writeText('{{ $order->tracking_number }}'); alert('Nomor resi berhasil disalin!');" class="text-blue-600 hover:text-blue-800 p-1 bg-blue-50 rounded-md transition" title="Salin Resi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                        </div>
                        <a href="https://cekresi.com/?noresi={{ $order->tracking_number }}" target="_blank" class="w-full flex justify-center items-center gap-2 bg-blue-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Lacak Paket
                        </a>
                    </div>
                @endif

                @if(in_array($order->status, ['shipped', 'delivered']))
                    <form action="{{ route('orders.complete', $order) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition" onclick="return confirm('Apakah Anda yakin telah menerima pesanan ini dengan baik?')">Pesanan Diterima</button>
                    </form>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h2 class="font-bold text-gray-900 mb-3">Pembayaran</h2>
                <p class="text-sm text-gray-600">Metode: {{ $order->payment->method === 'bank_transfer' ? 'Transfer Bank' : 'QRIS' }}</p>
                <p class="text-sm text-gray-600">Status: <span class="font-semibold">{{ $order->payment->status_label }}</span></p>
            </div>

            @if($order->notes)
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-3">Catatan</h2>
                    <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
