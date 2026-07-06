@extends('layouts.admin')
@section('title', 'Klaim Garansi')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold">Daftar Klaim Garansi</h2>
        <form action="{{ route('admin.warranty-claims.index') }}" method="GET" class="flex gap-3">
            <select name="status" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Masuk</option>
                <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Review</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                <option value="in_repair" {{ request('status') == 'in_repair' ? 'selected' : '' }}>Diperbaiki</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
        </form>
    </div>
    <div class="bg-white rounded-2xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">No. Klaim</th><th class="px-6 py-3 text-left">Pelanggan</th><th class="px-6 py-3 text-left">Produk</th><th class="px-6 py-3 text-center">Status</th><th class="px-6 py-3 text-center">Aksi</th></tr></thead>
            <tbody class="divide-y">
                @foreach($claims as $claim)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold">{{ $claim->claim_number }}</td>
                    <td class="px-6 py-4">{{ $claim->user->name ?? 'User Dihapus' }}</td>
                    <td class="px-6 py-4 font-semibold">{{ $claim->product->name ?? 'Produk Dihapus' }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 text-xs rounded-full {{ match($claim->status) { 'completed' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700', 'in_repair', 'approved' => 'bg-blue-100 text-blue-700', default => 'bg-yellow-100 text-yellow-700' } }}">{{ ucfirst(str_replace('_', ' ', $claim->status)) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.warranty-claims.show', $claim) }}" class="text-blue-600 font-medium">Detail</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $claims->links() }}</div>
@endsection
