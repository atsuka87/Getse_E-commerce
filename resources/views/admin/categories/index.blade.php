@extends('layouts.admin')
@section('title', 'Manajemen Kategori')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold">Daftar Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">+ Tambah Kategori</a>
    </div>
    <div class="bg-white rounded-2xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">Nama</th><th class="px-6 py-3 text-left">Slug</th><th class="px-6 py-3 text-center">Produk</th><th class="px-6 py-3 text-center">Status</th><th class="px-6 py-3 text-center">Aksi</th></tr></thead>
            <tbody class="divide-y">
                @foreach($categories as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold">{{ $cat->icon }} {{ $cat->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $cat->slug }}</td>
                    <td class="px-6 py-4 text-center">{{ $cat->products_count }}</td>
                    <td class="px-6 py-4 text-center"><span class="px-2 py-1 text-xs rounded-full {{ $cat->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-600 text-xs font-medium mr-2">Edit</a><form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-500 text-xs font-medium">Hapus</button></form></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
