@extends('layouts.admin')
@section('title', 'Detail Review')
@section('content')
<div class="max-w-2xl bg-white rounded-2xl border p-6">
    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
        <img src="{{ $review->product->primaryImage ? asset('storage/'.$review->product->primaryImage->image_path) : '' }}" class="w-16 h-16 rounded object-cover border" alt="">
        <div>
            <h3 class="font-bold">{{ $review->product->name }}</h3>
            <p class="text-sm text-gray-500">Oleh: {{ $review->user->name }} | No. Order: {{ $review->order->order_number ?? '-' }}</p>
        </div>
    </div>
    
    <div class="mb-6">
        <div class="text-2xl text-yellow-500 font-bold mb-2">
            @for($i = 1; $i <= 5; $i++)
                <span class="{{ $i <= $review->rating ? '' : 'text-gray-200' }}">★</span>
            @endfor
        </div>
        <p class="text-gray-800">{{ $review->comment ?: 'Tidak ada komentar.' }}</p>
        
        @if($review->images->count() > 0)
            <div class="flex gap-2 mt-4">
                @foreach($review->images as $img)
                    <img src="{{ asset('storage/'.$img->image_path) }}" class="w-24 h-24 rounded-lg object-cover border" alt="">
                @endforeach
            </div>
        @endif
    </div>

    <form action="{{ route('admin.reviews.update-status', $review) }}" method="POST" class="bg-gray-50 rounded-xl p-4 border">
        @csrf @method('PATCH')
        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Status Moderasi</label>
            <select name="status" class="w-full rounded-lg border-gray-300">
                <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $review->status === 'approved' ? 'selected' : '' }}>Setujui</option>
                <option value="rejected" {{ $review->status === 'rejected' ? 'selected' : '' }}>Tolak</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="block text-sm font-medium mb-1">Catatan Admin (opsional)</label>
            <textarea name="admin_notes" rows="2" class="w-full rounded-lg border-gray-300 text-sm">{{ $review->admin_notes }}</textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">Simpan Status</button>
    </form>
</div>
@endsection
