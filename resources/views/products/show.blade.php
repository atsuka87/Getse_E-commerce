@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-blue-600">Produk</a>
        <span>/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-blue-600">{{ $product->category->name }}</a>
        <span>/</span>
        <span class="text-gray-900 font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        {{-- Product Images --}}
        <div x-data="{ activeImage: 0 }">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 mb-4 aspect-square">
                @if($product->images->count() > 0)
                    @foreach($product->images as $i => $image)
                        <img x-show="activeImage === {{ $i }}"
                             src="{{ asset('storage/' . $image->image_path) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @endforeach
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>
            @if($product->images->count() > 1)
                <div class="grid grid-cols-5 gap-2">
                    @foreach($product->images as $i => $image)
                        <button @click="activeImage = {{ $i }}"
                                :class="activeImage === {{ $i }} ? 'ring-2 ring-blue-500' : 'ring-1 ring-gray-200'"
                                class="aspect-square rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                @if($product->brand)
                    <span class="text-sm text-gray-500">{{ $product->brand->name }}</span>
                @endif
                @if($product->condition !== 'new')
                    <span class="bg-yellow-50 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">{{ ucfirst($product->condition) }}</span>
                @endif
            </div>

            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="mb-6">
                @if($product->is_on_sale)
                    <div class="flex items-center gap-3">
                        <span class="text-3xl font-bold text-red-600">{{ formatRupiah($product->sale_price) }}</span>
                        <span class="text-lg text-gray-400 line-through">{{ formatRupiah($product->price) }}</span>
                        <span class="bg-red-100 text-red-600 text-sm font-bold px-2 py-1 rounded-lg">-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    </div>
                @else
                    <span class="text-3xl font-bold text-gray-900">{{ formatRupiah($product->price) }}</span>
                @endif
            </div>

            {{-- Stock --}}
            <div class="flex items-center gap-4 mb-6">
                @if($product->stock > 0)
                    <span class="flex items-center text-green-600 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Stok tersedia ({{ $product->stock }})
                    </span>
                @else
                    <span class="flex items-center text-red-500 text-sm font-medium">Stok Habis</span>
                @endif
                <span class="text-sm text-gray-400">{{ $product->views }}x dilihat</span>
            </div>

            {{-- Description --}}
            @if($product->short_description)
                <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>
            @endif

            {{-- Add to Cart --}}
            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-4 mb-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center border border-gray-300 rounded-xl" x-data="{ qty: 1 }">
                        <button type="button" @click="qty = Math.max(1, qty-1)" class="px-3 py-2 text-gray-600 hover:text-blue-600">−</button>
                        <input type="number" name="quantity" x-model="qty" min="1" max="{{ $product->stock }}" class="w-16 text-center border-0 focus:ring-0">
                        <button type="button" @click="qty = Math.min({{ $product->stock }}, qty+1)" class="px-3 py-2 text-gray-600 hover:text-blue-600">+</button>
                    </div>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl font-bold transition hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                        Tambah ke Keranjang
                    </button>
                </form>
            @endif

            {{-- WhatsApp & Instagram --}}
            <div class="flex gap-3 mb-8">
                <a href="{{ whatsappLink('Halo, saya tertarik dengan produk *' . $product->name . '* seharga *' . formatRupiah($product->display_price) . '*. Apakah masih tersedia?') }}"
                   target="_blank"
                   class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-xl font-semibold transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    Tanya via WhatsApp
                </a>
                @if($product->instagram_url)
                    <a href="{{ $product->instagram_url }}" target="_blank"
                       class="bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 px-4 rounded-xl font-semibold transition hover:shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        Lihat di Instagram
                    </a>
                @endif
            </div>

            {{-- Warranties --}}
            @if($product->warranties->count() > 0)
                <div class="bg-green-50 rounded-2xl p-5 mb-8 border border-green-100">
                    <h3 class="font-bold text-green-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Informasi Garansi
                    </h3>
                    <div class="space-y-2">
                        @foreach($product->warranties as $warranty)
                            <div class="flex items-center gap-3 bg-white rounded-lg p-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ $warranty->type === 'store' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-sm text-gray-800">{{ $warranty->duration_label }}</div>
                                    <div class="text-xs text-gray-500">{{ $warranty->type_label }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Specifications --}}
    @if($product->specs->count() > 0)
        <div class="mt-12 bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <h2 class="text-xl font-bold text-gray-900 p-6 border-b">Spesifikasi Teknis</h2>
            <div class="divide-y">
                @foreach($product->specs as $spec)
                    <div class="flex px-6 py-3 {{ $loop->even ? 'bg-gray-50' : '' }}">
                        <span class="w-1/3 text-sm font-medium text-gray-600">{{ $spec->spec_key }}</span>
                        <span class="w-2/3 text-sm text-gray-900">{{ $spec->spec_value }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Description --}}
    @if($product->description)
        <div class="mt-8 bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Produk</h2>
            <div class="prose prose-sm max-w-none text-gray-600">{!! nl2br(e($product->description)) !!}</div>
        </div>
    @endif

    {{-- Reviews --}}
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Ulasan Pelanggan ({{ $product->approvedReviews->count() }})</h2>

        @if($product->approvedReviews->count() > 0)
            <div class="space-y-4">
                @foreach($product->approvedReviews as $review)
                    <div class="border-b border-gray-100 pb-4 last:border-0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-sm">{{ strtoupper(substr($review->user->name, 0, 1)) }}</div>
                            <div>
                                <span class="font-semibold text-sm">{{ $review->user->name }}</span>
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <span class="text-xs text-gray-400 ml-auto">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @if($review->comment)
                            <p class="text-sm text-gray-600 ml-11">{{ $review->comment }}</p>
                        @endif
                        @if($review->images->count() > 0)
                            <div class="flex gap-2 mt-2 ml-11">
                                @foreach($review->images as $img)
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-16 h-16 rounded-lg object-cover border" alt="Review image">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center py-8">Belum ada ulasan untuk produk ini.</p>
        @endif
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rProduct)
                    @include('components.product-card', ['product' => $rProduct])
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
