<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function social()
    {
        $settings = SocialSetting::all()->keyBy('key');
        return view('admin.settings.social', compact('settings'));
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'nullable|string|max:20',
            'instagram_url' => 'nullable|url',
            'instagram_username' => 'nullable|string|max:100',
            'store_name' => 'nullable|string|max:255',
            'store_address' => 'nullable|string',
            'store_email' => 'nullable|email',
            'store_phone' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:255',
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fields = [
            'whatsapp_number' => 'Nomor WhatsApp',
            'instagram_url' => 'URL Instagram',
            'instagram_username' => 'Username Instagram',
            'store_name' => 'Nama Toko',
            'store_address' => 'Alamat Toko',
            'store_email' => 'Email Toko',
            'store_phone' => 'Telepon Toko',
            'bank_name' => 'Nama Bank',
            'bank_account_number' => 'Nomor Rekening',
            'bank_account_name' => 'Nama Pemilik Rekening',
        ];

        foreach ($fields as $key => $label) {
            if ($request->has($key)) {
                SocialSetting::setValue($key, $request->input($key));
            }
        }

        if ($request->hasFile('qris_image')) {
            $path = $request->file('qris_image')->store('settings', 'public');
            SocialSetting::setValue('qris_image', $path);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
