{{-- Product Card Component --}}
<div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <div class="relative overflow-hidden aspect-square bg-gray-100">
            @if($product->primaryImage)
                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            @endif

            @if($product->is_on_sale)
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-lg">
                    {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                </div>
            @endif

            @if($product->is_featured)
                <div class="absolute top-3 right-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-2.5 py-1 rounded-lg">⭐ Unggulan</div>
            @endif
        </div>
    </a>

    <div class="p-4">
        <div class="flex items-center gap-2 mb-1.5">
            @if($product->category)
                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full font-medium">{{ $product->category->name }}</span>
            @endif
            @if($product->brand)
                <span class="text-xs text-gray-500">{{ $product->brand->name }}</span>
            @endif
        </div>

        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-2 text-sm leading-snug">{{ $product->name }}</h3>
        </a>

        <div class="mt-3 flex items-end justify-between">
            <div>
                @if($product->is_on_sale)
                    <span class="text-xs text-gray-400 line-through">{{ formatRupiah($product->price) }}</span>
                    <div class="text-lg font-bold text-red-600">{{ formatRupiah($product->sale_price) }}</div>
                @else
                    <div class="text-lg font-bold text-gray-900">{{ formatRupiah($product->price) }}</div>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition hover:shadow-md" title="Tambah ke keranjang">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </button>
            </form>
        </div>

        @if($product->stock <= 0)
            <div class="mt-2 text-xs text-red-500 font-medium">Stok Habis</div>
        @elseif($product->isLowStock())
            <div class="mt-2 text-xs text-orange-500 font-medium">Sisa {{ $product->stock }} unit</div>
        @endif
    </div>
</div>
