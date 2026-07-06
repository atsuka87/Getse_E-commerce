@extends('layouts.app')
@section('title', 'Detail Klaim ' . $warrantyClaim->claim_number)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('warranty-claims.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Klaim Garansi
        </a>
        <span class="px-4 py-2 rounded-full text-xs font-bold tracking-wide uppercase border
            {{ match($warrantyClaim->status) {
                'completed' => 'bg-green-100 text-green-700 border-green-200/50',
                'rejected' => 'bg-red-100 text-red-700 border-red-200/50',
                'approved' => 'bg-emerald-100 text-emerald-700 border-emerald-200/50',
                'in_repair' => 'bg-indigo-100 text-indigo-700 border-indigo-200/50',
                'under_review' => 'bg-blue-100 text-blue-700 border-blue-200/50',
                default => 'bg-yellow-100 text-yellow-700 border-yellow-200/50'
            } }}">{{ $warrantyClaim->status_label }}</span>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $warrantyClaim->claim_number }}</h1>
        <p class="text-sm text-gray-500 mt-1">Diajukan pada {{ $warrantyClaim->created_at->format('d F Y \p\u\k\u\l H:i') }} WIB</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            {{-- Product Info Card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Produk Yang Diklaim
                </h2>
                <div class="flex flex-col sm:flex-row gap-6">
                    <div class="w-24 h-24 bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden flex-shrink-0 flex items-center justify-center">
                        @if($warrantyClaim->product && $warrantyClaim->product->primaryImage)
                            <img src="{{ asset('storage/' . $warrantyClaim->product->primaryImage->image_path) }}" class="w-full h-full object-cover" alt="{{ $warrantyClaim->product->name }}">
                        @else
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $warrantyClaim->product->name }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            <p class="text-gray-500">No. Order: <a href="{{ route('orders.show', $warrantyClaim->order_id) }}" class="font-bold text-blue-600 hover:text-blue-700 transition">{{ $warrantyClaim->order->order_number ?? '-' }}</a></p>
                            <p class="text-gray-500">Tipe Garansi: <span class="font-semibold text-gray-800">{{ $warrantyClaim->warranty->duration_label ?? '-' }}</span></p>
                            <p class="text-gray-500">SKU: <span class="font-semibold text-gray-800">{{ $warrantyClaim->product->sku ?? '-' }}</span></p>
                            <p class="text-gray-500">Kondisi: <span class="font-semibold text-gray-800">{{ $warrantyClaim->product->condition === 'new' ? 'Baru' : 'Bekas' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Issue Card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Detail Kerusakan / Masalah
                </h2>
                <div class="bg-gray-50/50 border border-gray-100 rounded-2xl p-5 text-gray-700 text-base leading-relaxed whitespace-pre-line">
                    {{ $warrantyClaim->issue_description }}
                </div>
            </div>

            {{-- Attachment Images Card --}}
            @if($warrantyClaim->images->count() > 0)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Foto Lampiran
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($warrantyClaim->images as $img)
                            <div class="group relative aspect-square bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Lampiran">
                                <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Timeline / Status Tracker Sidebar --}}
        <div class="space-y-6">
            {{-- Status Timeline --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Status Klaim
                </h2>

                <div class="relative pl-6 border-l-2 border-gray-100 space-y-8">
                    @php
                        $statuses = [
                            'submitted' => ['label' => 'Diajukan', 'desc' => 'Klaim garansi berhasil dikirim dan menunggu respon tim admin.'],
                            'under_review' => ['label' => 'Ditinjau', 'desc' => 'Tim kami sedang meninjau dokumen dan kronologi keluhan.'],
                            'approved' => ['label' => 'Disetujui', 'desc' => 'Klaim disetujui. Silakan ikuti instruksi perbaikan dari admin.'],
                            'in_repair' => ['label' => 'Diperbaiki', 'desc' => 'Produk sedang dalam tahap penanganan dan perbaikan oleh teknisi.'],
                            'completed' => ['label' => 'Selesai', 'desc' => 'Klaim garansi telah diselesaikan. Produk dikembalikan kepada Anda.'],
                        ];

                        if ($warrantyClaim->status === 'rejected') {
                            $statuses['rejected'] = ['label' => 'Ditolak', 'desc' => 'Pengajuan klaim garansi ditolak. Cek catatan admin untuk detail alasan.'];
                        }

                        $reachedActive = false;
                        $currentStatus = $warrantyClaim->status;
                    @endphp

                    @foreach($statuses as $statusKey => $info)
                        @php
                            $isCurrent = $currentStatus === $statusKey;
                            // Check if this status has been passed
                            $statusKeys = array_keys($statuses);
                            $currentIndex = array_search($currentStatus, $statusKeys);
                            $thisIndex = array_search($statusKey, $statusKeys);
                            $isCompleted = $thisIndex <= $currentIndex;
                        @endphp
                        <div class="relative">
                            {{-- Point icon --}}
                            <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full border-2 transition-colors duration-300
                                {{ $isCurrent ? 'bg-blue-600 border-blue-600 ring-4 ring-blue-50' : ($isCompleted ? 'bg-green-500 border-green-500' : 'bg-white border-gray-300') }}"></div>
                            <div>
                                <h4 class="font-bold text-sm {{ $isCurrent ? 'text-blue-600' : ($isCompleted ? 'text-gray-900' : 'text-gray-400') }}">{{ $info['label'] }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $info['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Admin Notes Card --}}
            @if($warrantyClaim->admin_notes || $warrantyClaim->resolution)
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Catatan Admin
                    </h2>
                    @if($warrantyClaim->admin_notes)
                        <div class="mb-4">
                            <span class="text-xs font-bold text-gray-400 block mb-1">Catatan:</span>
                            <p class="text-sm text-gray-700 bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">{{ $warrantyClaim->admin_notes }}</p>
                        </div>
                    @endif
                    @if($warrantyClaim->resolution)
                        <div>
                            <span class="text-xs font-bold text-gray-400 block mb-1">Solusi / Resolusi:</span>
                            <p class="text-sm text-emerald-800 bg-emerald-50 px-4 py-3 rounded-xl border border-emerald-100 font-medium">{{ $warrantyClaim->resolution }}</p>
                            @if($warrantyClaim->resolved_at)
                                <span class="text-[10px] text-gray-400 block mt-1">Diselesaikan pada: {{ $warrantyClaim->resolved_at->format('d M Y H:i') }}</span>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
