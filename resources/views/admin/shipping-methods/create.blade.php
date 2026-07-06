@extends('layouts.admin')
@section('title', 'Tambah Metode Pengiriman')
@section('content')
<div class="max-w-2xl bg-white rounded-2xl border p-6">
    <h2 class="text-lg font-bold mb-6">Tambah Metode Pengiriman Baru</h2>
    <form action="{{ route('admin.shipping-methods.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama Kurir & Daerah Tujuan <span class="text-xs text-gray-500 font-normal">(misal: JNE - Jakarta, Grab - Dalam Kota)</span></label>
            <input type="text" name="name" class="w-full rounded-lg border-gray-300" required>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Biaya Pengiriman (Rp)</label>
            <input type="number" name="cost" class="w-full rounded-lg border-gray-300" min="0" required>
        </div>
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-blue-600" checked>
                <span class="ml-2 text-sm">Aktifkan Metode Ini</span>
            </label>
        </div>
        <div class="pt-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.shipping-methods.index') }}" class="ml-2 text-gray-600 hover:text-gray-800 text-sm">Batal</a>
        </div>
    </form>
</div>
@endsection
