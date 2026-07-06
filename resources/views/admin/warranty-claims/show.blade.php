@extends('layouts.admin')
@section('title', 'Detail Klaim: ' . $warrantyClaim->claim_number)
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold mb-4">Informasi Klaim</h3>
        <div class="space-y-3 text-sm">
            <p><span class="text-gray-500 w-32 inline-block">Produk:</span> <span class="font-semibold">{{ $warrantyClaim->product->name ?? 'Produk Dihapus' }}</span></p>
            <p><span class="text-gray-500 w-32 inline-block">Pelanggan:</span> {{ $warrantyClaim->user->name ?? 'User Dihapus' }}</p>
            <p><span class="text-gray-500 w-32 inline-block">No. Order:</span> {{ $warrantyClaim->order->order_number ?? '-' }}</p>
            <p><span class="text-gray-500 w-32 inline-block">Tipe Garansi:</span> {{ $warrantyClaim->warranty->type_label ?? '-' }}</p>
            <div class="pt-3 border-t">
                <span class="text-gray-500 block mb-1">Masalah:</span>
                <p class="text-gray-800">{{ $warrantyClaim->issue_description }}</p>
            </div>
            @if($warrantyClaim->images->count() > 0)
                <div class="pt-3">
                    <span class="text-gray-500 block mb-2">Foto Lampiran:</span>
                    <div class="flex gap-2 overflow-x-auto">
                        @foreach($warrantyClaim->images as $img)
                            <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank"><img src="{{ asset('storage/' . $img->image_path) }}" class="h-20 rounded border object-cover"></a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold mb-4">Update Status Klaim</h3>
        <form action="{{ route('admin.warranty-claims.update-status', $warrantyClaim) }}" method="POST" class="space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300">
                    @foreach(['submitted' => 'Masuk', 'under_review' => 'Review', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'in_repair' => 'Diperbaiki', 'completed' => 'Selesai'] as $val => $label)
                        <option value="{{ $val }}" {{ $warrantyClaim->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Catatan Admin</label>
                <textarea name="admin_notes" rows="2" class="w-full rounded-lg border-gray-300 text-sm">{{ $warrantyClaim->admin_notes }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Resolusi (Bila Selesai)</label>
                <textarea name="resolution" rows="2" class="w-full rounded-lg border-gray-300 text-sm" placeholder="Tindakan penyelesaian...">{{ $warrantyClaim->resolution }}</textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700">Update Status</button>
        </form>
    </div>
</div>
@endsection
