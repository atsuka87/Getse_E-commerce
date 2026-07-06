@extends('layouts.app')
@section('title', 'Klaim Garansi')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Klaim Garansi</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau status pengajuan klaim garansi produk Anda.</p>
        </div>
        <a href="{{ route('warranty-claims.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-5 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Ajukan Klaim Baru
        </a>
    </div>

    @if($claims->count() > 0)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="divide-y divide-gray-100">
                @foreach($claims as $claim)
                    <div class="p-6 hover:bg-gray-50/50 transition">
                        <div class="flex flex-col md:flex-row md:items-center gap-6">
                            {{-- Product Image --}}
                            <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex-shrink-0 flex items-center justify-center">
                                @if($claim->product && $claim->product->primaryImage)
                                    <img src="{{ asset('storage/' . $claim->product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="{{ $claim->product->name }}">
                                @else
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>

                            {{-- Claim Details --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="font-bold text-gray-900 text-lg">{{ $claim->claim_number }}</span>
                                    <span class="text-xs text-gray-400">•</span>
                                    <span class="text-sm text-gray-500">{{ $claim->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <h3 class="font-bold text-gray-900 text-base mb-1 truncate">{{ $claim->product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    No. Order: <span class="font-medium text-gray-700">{{ $claim->order->order_number ?? '-' }}</span>
                                    <span class="mx-1.5 text-gray-300">|</span>
                                    Garansi: <span class="font-medium text-gray-700">{{ $claim->warranty->duration_label ?? '-' }}</span>
                                </p>
                                <p class="text-sm text-gray-600 line-clamp-1 italic bg-gray-50/80 px-3 py-1.5 rounded-lg border border-gray-100 inline-block max-w-full">
                                    "{{ $claim->issue_description }}"
                                </p>
                            </div>

                            {{-- Status & Link --}}
                            <div class="flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-4 flex-shrink-0">
                                <span class="px-3 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase
                                    {{ match($claim->status) {
                                        'completed' => 'bg-green-100 text-green-700 border border-green-200/50',
                                        'rejected' => 'bg-red-100 text-red-700 border border-red-200/50',
                                        'approved' => 'bg-emerald-100 text-emerald-700 border border-emerald-200/50',
                                        'in_repair' => 'bg-indigo-100 text-indigo-700 border border-indigo-200/50',
                                        'under_review' => 'bg-blue-100 text-blue-700 border border-blue-200/50',
                                        default => 'bg-yellow-100 text-yellow-700 border border-yellow-200/50'
                                    } }}">{{ $claim->status_label }}</span>
                                <a href="{{ route('warranty-claims.show', $claim) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-6">
            {{ $claims->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
            <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pengajuan Klaim</h3>
            <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6">Anda tidak memiliki riwayat pengajuan klaim garansi saat ini. Anda dapat mengajukan klaim untuk produk yang telah selesai dibeli.</p>
            <a href="{{ route('warranty-claims.create') }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 shadow-md hover:shadow-lg transition">
                Ajukan Klaim Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
