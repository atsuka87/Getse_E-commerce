@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pesanan Saya</h1>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-2xl border border-gray-100 p-6 hover:border-blue-200 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="font-bold text-gray-900">{{ $order->order_number }}</span>
                            <span class="text-sm text-gray-400 ml-2">{{ $order->created_at->format('d M Y H:i') }}</span>
                        </div>
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
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-2">
                            @foreach($order->items->take(3) as $item)
                                <div class="w-12 h-12 rounded-lg overflow-hidden border-2 border-white bg-gray-100">
                                    @if($item->product && $item->product->primaryImage)
                                        <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="">
                                    @endif
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <div class="w-12 h-12 rounded-lg bg-gray-200 border-2 border-white flex items-center justify-center text-xs text-gray-500 font-bold">+{{ $order->items->count() - 3 }}</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span class="text-sm text-gray-500">{{ $order->items->count() }} produk</span>
                        </div>
                        <span class="text-lg font-bold text-gray-900">{{ formatRupiah($order->total) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">{{ $orders->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <h3 class="text-lg font-semibold text-gray-600">Belum Ada Pesanan</h3>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
