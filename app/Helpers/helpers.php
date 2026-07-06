<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount, $prefix = 'Rp '): string
    {
        return $prefix . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('socialSetting')) {
    function socialSetting(string $key, $default = null)
    {
        return \App\Models\SocialSetting::getValue($key, $default);
    }
}

if (!function_exists('whatsappLink')) {
    function whatsappLink(string $message = '', ?string $number = null): string
    {
        $number = $number ?? \App\Models\SocialSetting::getWhatsappNumber();
        $url = "https://wa.me/{$number}";
        if ($message) {
            $url .= '?text=' . urlencode($message);
        }
        return $url;
    }
}
