<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = ['product_id', 'type', 'duration_days', 'duration_label', 'description', 'terms'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function claims()
    {
        return $this->hasMany(WarrantyClaim::class);
    }

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'store' => 'Garansi Toko',
            'supplier' => 'Garansi Supplier',
            'official' => 'Garansi Resmi',
            default => $this->type,
        };
    }
}
