@extends('layouts.admin')
@section('title', 'Manajemen Pengiriman')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold">Daftar Metode Pengiriman</h2>
        <a href="{{ route('admin.shipping-methods.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">+ Tambah Pengiriman</a>
    </div>
    <div class="bg-white rounded-2xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">Nama Kurir</th><th class="px-6 py-3 text-left">Biaya</th><th class="px-6 py-3 text-center">Status</th><th class="px-6 py-3 text-center">Aksi</th></tr></thead>
            <tbody class="divide-y">
                @forelse($shippingMethods as $method)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold">{{ $method->name }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ formatRupiah($method->cost) }}</td>
                    <td class="px-6 py-4 text-center"><span class="px-2 py-1 text-xs rounded-full {{ $method->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ $method->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.shipping-methods.edit', $method) }}" class="text-blue-600 text-xs font-medium mr-2">Edit</a>
                        <form action="{{ route('admin.shipping-methods.destroy', $method) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-red-500 text-xs font-medium">Hapus</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada metode pengiriman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $shippingMethods->links() }}</div>
@endsection
