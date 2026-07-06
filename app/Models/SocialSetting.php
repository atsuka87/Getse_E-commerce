<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SocialSetting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'type'];

    public static function getValue(string $key, $default = null)
    {
        return Cache::remember("social_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function setValue(string $key, $value)
    {
        $setting = static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("social_setting_{$key}");
        return $setting;
    }

    public static function getWhatsappNumber()
    {
        return static::getValue('whatsapp_number', '628123456789');
    }

    public static function getInstagramUrl()
    {
        return static::getValue('instagram_url', 'https://instagram.com/dewielektro');
    }

    public static function getInstagramUsername()
    {
        return static::getValue('instagram_username', '@dewielektro');
    }
}
