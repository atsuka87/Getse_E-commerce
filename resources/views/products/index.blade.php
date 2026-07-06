@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar Filter --}}
        <aside class="lg:w-64 flex-shrink-0" x-data="{ showFilter: false }">
            <button @click="showFilter = !showFilter" class="lg:hidden w-full bg-white rounded-xl px-4 py-3 mb-4 flex items-center justify-between border">
                <span class="font-semibold">Filter</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
            </button>
            <div :class="showFilter ? '' : 'hidden lg:block'">
                <form action="{{ route('products.index') }}" method="GET" class="bg-white rounded-2xl p-6 space-y-6 border border-gray-100">
                    {{-- Search --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Brand --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Brand</label>
                        <select name="brand" class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->slug }}" {{ request('brand') == $brand->slug ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Harga</label>
                        <div class="flex gap-2 mt-1">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-1/2 rounded-lg border-gray-300 text-sm">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-1/2 rounded-lg border-gray-300 text-sm">
                        </div>
                    </div>

                    {{-- Condition --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Kondisi</label>
                        <select name="condition" class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kondisi</option>
                            <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>Baru</option>
                            <option value="second" {{ request('condition') == 'second' ? 'selected' : '' }}>Bekas</option>
                            <option value="refurbished" {{ request('condition') == 'refurbished' ? 'selected' : '' }}>Refurbished</option>
                        </select>
                    </div>

                    {{-- Sort --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Urutkan</label>
                        <select name="sort" class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition">Terapkan Filter</button>
                    <a href="{{ route('products.index') }}" class="block text-center text-sm text-gray-500 hover:text-gray-700">Reset Filter</a>
                </form>
            </div>
        </aside>

        {{-- Products Grid --}}
        <div class="flex-1">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Semua Produk</h1>
                <span class="text-sm text-gray-500">{{ $products->total() }} produk ditemukan</span>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl border">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h3 class="text-lg font-semibold text-gray-600">Produk tidak ditemukan</h3>
                    <p class="text-gray-400 mt-1">Coba ubah filter pencarian Anda</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
