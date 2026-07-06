@extends('layouts.app')
@section('title', 'Ajukan Klaim Garansi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{
    selectedOrder: '',
    selectedProduct: '',
    selectedWarranty: '',
    orders: {{ json_encode($orders) }},
    get products() {
        if (!this.selectedOrder) return [];
        const order = this.orders.find(o => o.id == this.selectedOrder);
        if (!order || !order.items) return [];
        return order.items.map(item => item.product).filter(Boolean);
    },
    get warranties() {
        if (!this.selectedProduct) return [];
        const product = this.products.find(p => p.id == this.selectedProduct);
        return product && product.warranties ? product.warranties : [];
    },
    get isPast7Days() {
        if (!this.selectedOrder) return false;
        const order = this.orders.find(o => o.id == this.selectedOrder);
        if (!order || !order.completed_at) return false;
        const completedDate = new Date(order.completed_at);
        const diffTime = Math.abs(new Date() - completedDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays > 7;
    }
}">
    <div class="mb-6">
        <a href="{{ route('warranty-claims.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Klaim Garansi
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-10">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Ajukan Klaim Garansi</h1>
        <p class="text-sm text-gray-500 mb-4">Pilih pesanan, produk, dan isi detail keluhan untuk memproses klaim garansi Anda.</p>

        <div class="mb-8 p-4 bg-blue-50 text-blue-800 rounded-xl text-sm border border-blue-200">
            <strong>Catatan Penting:</strong> Lewat dari 7 hari setelah pesanan selesai, garansi toko sudah habis dan toko hanya memberi alamat supplier untuk keperluan klaim Anda.
        </div>

        @if($orders->count() > 0)
            <form action="{{ route('warranty-claims.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Select Order --}}
                <div>
                    <label for="order_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Pesanan</label>
                    <select id="order_id" name="order_id" x-model="selectedOrder" @change="selectedProduct = ''; selectedWarranty = ''" required
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-3 transition">
                        <option value="">-- Pilih Nomor Pesanan --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->order_number }} (Selesai: {{ $order->completed_at ? $order->completed_at->format('d M Y') : $order->updated_at->format('d M Y') }})</option>
                        @endforeach
                    </select>
                    @error('order_id')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                {{-- Warning if past 7 days --}}
                <div x-show="isPast7Days" x-cloak class="p-5 bg-amber-50 border border-amber-200 rounded-xl mb-6 text-amber-800">
                    <p class="font-bold mb-2">Pesanan ini telah melewati 7 hari sejak selesai.</p>
                    <p class="text-sm mb-2">Sesuai kebijakan, klaim garansi toko sudah tidak berlaku. Namun, Anda dapat langsung melakukan klaim garansi ke alamat supplier resmi kami berikut ini:</p>
                    <div class="bg-white p-4 rounded-lg border border-amber-100 text-sm mt-3">
                        <strong class="block mb-1">Pusat Klaim Supplier/Distributor:</strong>
                        PT. Distributor Elektronik Nasional<br>
                        Gedung Harco Mangga Dua, Blok A No. 12-15<br>
                        Jakarta Pusat, DKI Jakarta 10730<br>
                        <strong>Email:</strong> support@distributor-elektronik.com<br>
                        <strong>No. Telepon:</strong> 021-12345678
                    </div>
                </div>

                {{-- Select Product --}}
                <div x-show="selectedOrder && !isPast7Days" x-cloak>
                    <label for="product_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Produk</label>
                    <select id="product_id" name="product_id" x-model="selectedProduct" @change="selectedWarranty = ''" required
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-3 transition">
                        <option value="">-- Pilih Produk --</option>
                        <template x-for="product in products" :key="product.id">
                            <option :value="product.id" x-text="product.name"></option>
                        </template>
                    </select>
                    @error('product_id')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                {{-- Select Warranty --}}
                <div x-show="selectedProduct && !isPast7Days" x-cloak>
                    <label for="warranty_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Tipe Garansi</label>
                    <select id="warranty_id" name="warranty_id" x-model="selectedWarranty" required
                            class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-3 transition">
                        <option value="">-- Pilih Tipe Garansi --</option>
                        <template x-for="warranty in warranties" :key="warranty.id">
                            <option :value="warranty.id" x-text="warranty.duration_label"></option>
                        </template>
                    </select>
                    @error('warranty_id')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                {{-- Issue Description --}}
                <div x-show="!isPast7Days">
                    <label for="issue_description" class="block text-sm font-bold text-gray-700 mb-2">Detail Keluhan / Masalah</label>
                    <textarea id="issue_description" name="issue_description" rows="5" required
                              placeholder="Jelaskan secara detail kerusakan atau masalah pada produk Anda..."
                              class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-4 transition"></textarea>
                    <p class="text-xs text-gray-400 mt-1">Berikan kronologi atau penjelasan sejelas-jelasnya agar tim kami dapat memverifikasi klaim Anda lebih cepat.</p>
                    @error('issue_description')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                {{-- Upload Images --}}
                <div x-show="!isPast7Days">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Produk (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-gray-400 transition">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h16a4 4 0 004-4V12a4 4 0 00-4-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 29l7-7 7 7M26 21l3-3 6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="18" cy="18" r="3" stroke-width="2" fill="none" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="images" class="relative cursor-pointer bg-white rounded-md font-semibold text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Pilih File Foto</span>
                                    <input id="images" name="images[]" type="file" multiple accept="image/*" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB per foto. Bisa memilih beberapa foto sekaligus.</p>
                        </div>
                    </div>
                    @error('images')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                {{-- Action Buttons --}}
                <div x-show="!isPast7Days" class="pt-4 border-t border-gray-100 flex items-center justify-end gap-4">
                    <a href="{{ route('warranty-claims.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Batal</a>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all">
                        Kirim Pengajuan Klaim
                    </button>
                </div>
            </form>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Tidak Ada Produk yang Dapat Diklaim</h3>
                <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6">Anda hanya dapat mengajukan klaim garansi untuk produk dari pesanan yang berstatus selesai (completed) dan memiliki opsi garansi aktif.</p>
                <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-blue-700 transition">
                    Lihat Pesanan Saya
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
