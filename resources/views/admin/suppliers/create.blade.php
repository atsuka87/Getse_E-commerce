@extends('layouts.admin')
@section('title', 'Tambah Supplier')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.suppliers.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
        <h2 class="text-xl font-bold">Tambah Supplier Baru</h2>
    </div>

    <form action="{{ route('admin.suppliers.store') }}" method="POST" class="bg-white rounded-2xl border p-6 space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama Supplier <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300">
            @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium mb-1">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-gray-300">
                @error('phone')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300">
                @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
            <textarea name="address" rows="3" class="w-full rounded-lg border-gray-300">{{ old('address') }}</textarea>
            @error('address')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>

        <div class="pt-4 border-t flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">Simpan Supplier</button>
        </div>
    </form>
</div>
@endsection
