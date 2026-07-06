@extends('layouts.admin')
@section('title', 'Manajemen Supplier')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold">Daftar Supplier</h2>
    <a href="{{ route('admin.suppliers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">Tambah Supplier</a>
</div>

<div class="bg-white rounded-2xl border overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
        <form action="{{ route('admin.suppliers.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama supplier..." class="rounded-lg border-gray-300 text-sm">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold">Cari</button>
        </form>
    </div>

    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 font-semibold text-gray-700">Nama Supplier</th>
                <th class="px-6 py-4 font-semibold text-gray-700">Telepon</th>
                <th class="px-6 py-4 font-semibold text-gray-700">Email</th>
                <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($suppliers as $supplier)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $supplier->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $supplier->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $supplier->email ?? '-' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data supplier.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($suppliers->hasPages())
        <div class="p-4 border-t">
            {{ $suppliers->links() }}
        </div>
    @endif
</div>
@endsection
