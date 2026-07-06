@extends('layouts.admin')
@section('title', 'Pengaturan Toko & Sosial Media')
@section('content')
<form action="{{ route('admin.settings.social.update') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl space-y-6">
    @csrf

    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold mb-4 text-lg">Informasi Toko</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Nama Toko</label>
                <input type="text" name="store_name" value="{{ $settings['store_name']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                <textarea name="store_address" rows="3" class="w-full rounded-lg border-gray-300">{{ $settings['store_address']->value ?? '' }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email Toko</label>
                <input type="email" name="store_email" value="{{ $settings['store_email']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">No. Telepon (Fixed Line / CS)</label>
                <input type="text" name="store_phone" value="{{ $settings['store_phone']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold mb-4 text-lg">Sosial Media & Chat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nomor WhatsApp (Contoh: 62812...)</label>
                <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Username Instagram (Contoh: @dewielektro)</label>
                <input type="text" name="instagram_username" value="{{ $settings['instagram_username']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">URL Profil Instagram</label>
                <input type="url" name="instagram_url" value="{{ $settings['instagram_url']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border p-6">
        <h3 class="font-bold mb-4 text-lg">Rekening Pembayaran Bank & QRIS</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Bank</label>
                <input type="text" name="bank_name" value="{{ $settings['bank_name']->value ?? '' }}" class="w-full rounded-lg border-gray-300" placeholder="Contoh: Bank BCA">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nomor Rekening</label>
                <input type="text" name="bank_account_number" value="{{ $settings['bank_account_number']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Nama Pemilik Rekening</label>
                <input type="text" name="bank_account_name" value="{{ $settings['bank_account_name']->value ?? '' }}" class="w-full rounded-lg border-gray-300">
            </div>
            <div class="md:col-span-2 mt-4 pt-4 border-t">
                <label class="block text-sm font-medium mb-1">Gambar QRIS</label>
                @if(isset($settings['qris_image']) && $settings['qris_image']->value)
                    <img src="{{ asset('storage/' . $settings['qris_image']->value) }}" class="h-48 object-contain mb-3 border rounded-lg p-2" alt="QRIS">
                @endif
                <input type="file" name="qris_image" accept="image/*" class="w-full text-sm">
            </div>
        </div>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Simpan Pengaturan</button>
</form>
@endsection
