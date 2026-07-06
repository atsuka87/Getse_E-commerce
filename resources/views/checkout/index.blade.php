@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="{ shippingCost: 0, subtotal: {{ $total }} }">
            {{-- Shipping Info --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Alamat Pengiriman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima *</label>
                            <input type="text" name="shipping_name" value="{{ old('shipping_name', $user->name) }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @error('shipping_name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon *</label>
                            <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $user->phone) }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @error('shipping_phone')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap *</label>
                            <textarea name="shipping_address" rows="3" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('shipping_address', $user->address) }}</textarea>
                            @error('shipping_address')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota *</label>
                            <input type="text" name="shipping_city" value="{{ old('shipping_city', $user->city) }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi *</label>
                            <input type="text" name="shipping_province" value="{{ old('shipping_province', $user->province) }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos *</label>
                            <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code', $user->postal_code) }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Metode Pengiriman</h2>
                    <div class="space-y-3" x-data="{ selectedShipping: '' }">
                        @foreach($shippingMethods as $method)
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer transition hover:border-gray-300" :class="selectedShipping == '{{ $method->id }}' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'">
                            <input type="radio" name="shipping_method_id" value="{{ $method->id }}" x-model="selectedShipping" @change="shippingCost = {{ intval($method->cost) }}" class="text-blue-600 focus:ring-blue-500" required>
                            <div class="ml-3 flex-1 flex justify-between">
                                <span class="font-semibold text-gray-900">{{ $method->name }}</span>
                                <span class="text-gray-900 font-medium">{{ formatRupiah($method->cost) }}</span>
                            </div>
                        </label>
                        @endforeach
                        @if($shippingMethods->isEmpty())
                            <p class="text-red-500 text-sm">Belum ada metode pengiriman tersedia.</p>
                        @endif
                        @error('shipping_method_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Metode Pembayaran</h2>
                    <div class="space-y-3" x-data="{ method: 'bank_transfer' }">
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer transition" :class="method === 'bank_transfer' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="payment_method" value="bank_transfer" x-model="method" class="text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <span class="font-semibold text-gray-900">Transfer Bank</span>
                                <p class="text-xs text-gray-500">{{ socialSetting('bank_name', 'Bank BCA') }} - {{ socialSetting('bank_account_number', '1234567890') }} a/n {{ socialSetting('bank_account_name', 'PT Dewi Elektronik') }}</p>
                            </div>
                        </label>
                        <label class="flex items-start p-4 border rounded-xl cursor-pointer transition" :class="method === 'qris' ? 'border-green-500 bg-green-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="payment_method" value="qris" x-model="method" class="text-green-600 focus:ring-green-500 mt-1">
                            <div class="ml-3 w-full">
                                <span class="font-semibold text-gray-900">QRIS</span>
                                <p class="text-xs text-gray-500 mb-3">Scan kode QR untuk pembayaran</p>
                                @php $qrisImage = socialSetting('qris_image'); @endphp
                                @if($qrisImage)
                                    <div x-show="method === 'qris'" x-transition class="flex flex-col items-center gap-2">
                                        <img src="{{ asset('storage/' . $qrisImage) }}"
                                             alt="QRIS Toko"
                                             class="max-w-[220px] w-full border-2 border-green-200 rounded-xl p-2 bg-white shadow">
                                        <p class="text-xs text-green-700 font-medium">Scan QR di atas dengan aplikasi pembayaran Anda</p>
                                    </div>
                                @else
                                    <div x-show="method === 'qris'" x-transition>
                                        <p class="text-xs text-gray-500 italic">Gambar QRIS belum tersedia. Hubungi admin.</p>
                                    </div>
                                @endif
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Catatan untuk pesanan...">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3 mb-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 line-clamp-1 flex-1">{{ $item['product']->name }} (x{{ $item['quantity'] }})</span>
                                <span class="font-medium text-gray-900 ml-2">{{ formatRupiah($item['subtotal']) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span>{{ formatRupiah($total) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(shippingCost)">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold mt-2 pt-2 border-t">
                            <span>Total</span>
                            <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal + shippingCost)">{{ formatRupiah($total) }}</span>
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition hover:shadow-lg">Buat Pesanan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
