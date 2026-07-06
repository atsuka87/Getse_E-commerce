@extends('layouts.admin')
@section('title', 'Tambah Produk')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
    @csrf
    <div class="space-y-6">
        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Informasi Produk</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300">
                    @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full rounded-lg border-gray-300">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <select name="brand_id" class="w-full rounded-lg border-gray-300">
                        <option value="">Pilih Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga *</label>
                    <input type="number" name="price" value="{{ old('price') }}" required class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}" class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stok *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="w-full rounded-lg border-gray-300">
                    @error('sku')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Berat (gram)</label>
                    <input type="number" name="weight" value="{{ old('weight') }}" step="0.01" class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select name="status" required class="w-full rounded-lg border-gray-300">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                        <option value="out_of_stock">Habis</option>
                        <option value="discontinued">Discontinued</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi *</label>
                    <select name="condition" required class="w-full rounded-lg border-gray-300">
                        <option value="new">Baru</option>
                        <option value="second">Second</option>
                        <option value="refurbished">Refurbished</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="short_description" rows="2" class="w-full rounded-lg border-gray-300">{{ old('short_description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Instagram</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" class="w-full rounded-lg border-gray-300" placeholder="https://instagram.com/p/...">
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Produk Unggulan</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Images --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Gambar Produk</h2>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
            <p class="text-xs text-gray-400 mt-1">Upload multiple gambar. Gambar pertama menjadi gambar utama.</p>
        </div>

        {{-- Specifications --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data="{ specs: [{ key: '', value: '' }] }">
            <h2 class="font-bold text-gray-900 mb-4">Spesifikasi Teknis</h2>
            <template x-for="(spec, index) in specs" :key="index">
                <div class="flex gap-3 mb-2">
                    <input type="text" :name="'spec_keys[' + index + ']'" x-model="spec.key" placeholder="Nama (contoh: RAM)" class="flex-1 rounded-lg border-gray-300 text-sm">
                    <input type="text" :name="'spec_values[' + index + ']'" x-model="spec.value" placeholder="Nilai (contoh: 8 GB)" class="flex-1 rounded-lg border-gray-300 text-sm">
                    <button type="button" @click="specs.splice(index, 1)" class="text-red-400 hover:text-red-600" x-show="specs.length > 1">✕</button>
                </div>
            </template>
            <button type="button" @click="specs.push({ key: '', value: '' })" class="text-sm text-blue-600 hover:text-blue-700 font-medium">+ Tambah Spesifikasi</button>
        </div>

        {{-- Warranties --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data="{ warranties: [{ type: 'store', duration: 7, label: '7 Hari Garansi Toko', desc: '' }] }">
            <h2 class="font-bold text-gray-900 mb-4">Garansi</h2>
            <template x-for="(w, index) in warranties" :key="index">
                <div class="grid grid-cols-4 gap-3 mb-3 items-end">
                    <div>
                        <label class="text-xs font-medium text-gray-600">Tipe</label>
                        <select :name="'warranty_types[' + index + ']'" x-model="w.type" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="store">Garansi Toko</option>
                            <option value="supplier">Garansi Supplier</option>
                            <option value="official">Garansi Resmi</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-600">Durasi (hari)</label>
                        <input type="number" :name="'warranty_durations[' + index + ']'" x-model="w.duration" class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-600">Label</label>
                        <input type="text" :name="'warranty_labels[' + index + ']'" x-model="w.label" class="w-full rounded-lg border-gray-300 text-sm">
                    </div>
                    <button type="button" @click="warranties.splice(index, 1)" class="text-red-400 hover:text-red-600 pb-2" x-show="warranties.length > 1">✕</button>
                </div>
            </template>
            <button type="button" @click="warranties.push({ type: 'store', duration: '', label: '', desc: '' })" class="text-sm text-blue-600 hover:text-blue-700 font-medium">+ Tambah Garansi</button>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-600 font-semibold hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">Simpan Produk</button>
        </div>
    </div>
</form>
@endsection
