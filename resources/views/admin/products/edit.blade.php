@extends('layouts.admin')
@section('title', 'Edit Produk: ' . $product->name)

@section('content')
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
    @csrf @method('PUT')
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Informasi Produk</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-lg border-gray-300">
                    @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full rounded-lg border-gray-300">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <select name="brand_id" class="w-full rounded-lg border-gray-300">
                        <option value="">Pilih Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Harga *</label><input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full rounded-lg border-gray-300"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Harga Diskon</label><input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full rounded-lg border-gray-300"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Stok *</label><input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full rounded-lg border-gray-300"></div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full rounded-lg border-gray-300">
                    @error('sku')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Berat (gram)</label><input type="number" name="weight" value="{{ old('weight', $product->weight) }}" step="0.01" class="w-full rounded-lg border-gray-300"></div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300">
                        @foreach(['active' => 'Aktif', 'inactive' => 'Nonaktif', 'out_of_stock' => 'Habis', 'discontinued' => 'Discontinued'] as $val => $label)
                            <option value="{{ $val }}" {{ $product->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                    <select name="condition" class="w-full rounded-lg border-gray-300">
                        @foreach(['new' => 'Baru', 'second' => 'Second', 'refurbished' => 'Refurbished'] as $val => $label)
                            <option value="{{ $val }}" {{ $product->condition === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label><textarea name="short_description" rows="2" class="w-full rounded-lg border-gray-300">{{ old('short_description', $product->short_description) }}</textarea></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label><textarea name="description" rows="4" class="w-full rounded-lg border-gray-300">{{ old('description', $product->description) }}</textarea></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">URL Instagram</label><input type="url" name="instagram_url" value="{{ old('instagram_url', $product->instagram_url) }}" class="w-full rounded-lg border-gray-300"></div>
                <div class="flex items-center pt-6"><label class="flex items-center cursor-pointer"><input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="rounded text-blue-600"><span class="ml-2 text-sm font-medium text-gray-700">Produk Unggulan</span></label></div>
            </div>
        </div>

        {{-- Existing Images --}}
        @if($product->images->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Gambar Saat Ini</h2>
            <div class="grid grid-cols-5 gap-3">
                @foreach($product->images as $img)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full aspect-square object-cover rounded-xl border" alt="">
                        <button type="submit" form="delete-image-{{ $img->id }}" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition" onclick="return confirm('Hapus gambar?')">✕</button>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Tambah Gambar Baru</h2>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
        </div>

        {{-- Specs --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data='{ "specs": {{ json_encode($product->specs->map(fn($s) => ["key" => $s->spec_key, "value" => $s->spec_value])->values()->toArray() ?: [["key" => "", "value" => ""]]) }} }'>
            <h2 class="font-bold text-gray-900 mb-4">Spesifikasi Teknis</h2>
            <template x-for="(spec, index) in specs" :key="index">
                <div class="flex gap-3 mb-2">
                    <input type="text" :name="'spec_keys[' + index + ']'" x-model="spec.key" placeholder="Nama" class="flex-1 rounded-lg border-gray-300 text-sm">
                    <input type="text" :name="'spec_values[' + index + ']'" x-model="spec.value" placeholder="Nilai" class="flex-1 rounded-lg border-gray-300 text-sm">
                    <button type="button" @click="specs.splice(index, 1)" class="text-red-400 hover:text-red-600" x-show="specs.length > 1">✕</button>
                </div>
            </template>
            <button type="button" @click="specs.push({ key: '', value: '' })" class="text-sm text-blue-600 font-medium">+ Tambah Spesifikasi</button>
        </div>

        {{-- Warranties --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data='{ "warranties": {{ json_encode($product->warranties->map(fn($w) => ["type" => $w->type, "duration" => $w->duration_days, "label" => $w->duration_label, "desc" => $w->description])->values()->toArray() ?: [["type" => "store", "duration" => 7, "label" => "7 Hari Garansi Toko", "desc" => ""]]) }} }'>
            <h2 class="font-bold text-gray-900 mb-4">Garansi</h2>
            <template x-for="(w, index) in warranties" :key="index">
                <div class="grid grid-cols-4 gap-3 mb-3 items-end">
                    <div><select :name="'warranty_types[' + index + ']'" x-model="w.type" class="w-full rounded-lg border-gray-300 text-sm"><option value="store">Toko</option><option value="supplier">Supplier</option><option value="official">Resmi</option></select></div>
                    <div><input type="number" :name="'warranty_durations[' + index + ']'" x-model="w.duration" placeholder="Hari" class="w-full rounded-lg border-gray-300 text-sm"></div>
                    <div><input type="text" :name="'warranty_labels[' + index + ']'" x-model="w.label" placeholder="Label" class="w-full rounded-lg border-gray-300 text-sm"></div>
                    <button type="button" @click="warranties.splice(index, 1)" class="text-red-400 hover:text-red-600 pb-2" x-show="warranties.length > 1">✕</button>
                </div>
            </template>
            <button type="button" @click="warranties.push({ type: 'store', duration: '', label: '', desc: '' })" class="text-sm text-blue-600 font-medium">+ Tambah Garansi</button>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-600 font-semibold hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">Perbarui Produk</button>
        </div>
    </div>
</form>

@foreach($product->images as $img)
<form id="delete-image-{{ $img->id }}" action="{{ route('admin.product-images.destroy', $img) }}" method="POST" class="hidden">
    @csrf @method('DELETE')
</form>
@endforeach

@endsection
