@extends('layouts.admin')
@section('title', 'Tambah Brand')
@section('content')
<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="max-w-xl bg-white rounded-2xl border p-6">
    @csrf
    <div class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Brand *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Logo</label><input type="file" name="logo" accept="image/*" class="w-full text-sm"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label><textarea name="description" rows="3" class="w-full rounded-lg border-gray-300">{{ old('description') }}</textarea></div>
        <div class="flex items-center"><label class="flex items-center cursor-pointer"><input type="checkbox" name="is_active" value="1" checked class="rounded text-blue-600"><span class="ml-2 text-sm font-medium text-gray-700">Aktif</span></label></div>
        <div class="pt-4 flex gap-3">
            <a href="{{ route('admin.brands.index') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </div>
</form>
@endsection
