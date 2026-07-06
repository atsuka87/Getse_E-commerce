@extends('layouts.app')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Keranjang Belanja</h1>

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden mb-6">
            @foreach($cartItems as $item)
                <div class="flex items-center gap-4 p-4 border-b border-gray-100 last:border-0">
                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        @if($item['product']->primaryImage)
                            <img src="{{ asset('storage/' . $item['product']->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('products.show', $item['product']->slug) }}" class="font-semibold text-gray-900 hover:text-blue-600 line-clamp-1">{{ $item['product']->name }}</a>
                        <p class="text-sm text-gray-500">{{ formatRupiah($item['price']) }} x {{ $item['quantity'] }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-1">
                            @csrf @method('PATCH')
                            <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                            <button type="submit" name="quantity" value="{{ max(0, $item['quantity'] - 1) }}" class="w-8 h-8 rounded-lg border text-gray-600 hover:bg-gray-50 flex items-center justify-center">−</button>
                            <span class="w-10 text-center font-semibold">{{ $item['quantity'] }}</span>
                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="w-8 h-8 rounded-lg border text-gray-600 hover:bg-gray-50 flex items-center justify-center">+</button>
                        </form>
                        <span class="font-bold text-gray-900 w-32 text-right">{{ formatRupiah($item['subtotal']) }}</span>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                            <button type="submit" class="text-red-400 hover:text-red-600 p-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold text-gray-600">Total</span>
                <span class="text-2xl font-bold text-gray-900">{{ formatRupiah($total) }}</span>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('cart.clear') }}" method="POST" class="flex-shrink-0">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-50 font-semibold transition">Kosongkan</button>
                </form>
                <a href="{{ route('checkout.index') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-center transition hover:shadow-lg">Checkout</a>
            </div>
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            <h3 class="text-lg font-semibold text-gray-600">Keranjang Kosong</h3>
            <p class="text-gray-400 mt-1">Belum ada produk di keranjang Anda</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Belanja Sekarang</a>
        </div>
    @endif
</div>
@endsection
