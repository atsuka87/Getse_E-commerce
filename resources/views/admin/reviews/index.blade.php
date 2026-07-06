@extends('layouts.admin')
@section('title', 'Manajemen Review')
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold">Daftar Review</h2>
        <form action="{{ route('admin.reviews.index') }}" method="GET" class="flex gap-3">
            <select name="status" class="rounded-lg border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </form>
    </div>
    <div class="bg-white rounded-2xl border overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left">Produk</th><th class="px-6 py-3 text-left">Pelanggan</th><th class="px-6 py-3 text-center">Rating</th><th class="px-6 py-3 text-center">Status</th><th class="px-6 py-3 text-center">Aksi</th></tr></thead>
            <tbody class="divide-y">
                @foreach($reviews as $review)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $review->product->primaryImage ? asset('storage/'.$review->product->primaryImage->image_path) : '' }}" class="w-10 h-10 rounded bg-gray-100 object-cover" alt="">
                            <span class="font-semibold">{{ $review->product->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $review->user->name }}</td>
                    <td class="px-6 py-4 text-center text-yellow-500 font-bold">★ {{ $review->rating }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-1 text-xs rounded-full {{ match($review->status) { 'approved' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700', default => 'bg-yellow-100 text-yellow-700' } }}">{{ ucfirst($review->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center"><a href="{{ route('admin.reviews.show', $review) }}" class="text-blue-600 font-medium">Detail</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $reviews->links() }}</div>
@endsection
