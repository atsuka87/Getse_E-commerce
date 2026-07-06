<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarrantyClaim extends Model
{
    protected $fillable = [
        'claim_number', 'user_id', 'order_id', 'product_id', 'warranty_id',
        'issue_description', 'status', 'admin_notes', 'resolution', 'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($claim) {
            if (empty($claim->claim_number)) {
                $claim->claim_number = 'WC-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }

    public function images()
    {
        return $this->hasMany(WarrantyClaimImage::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'submitted' => 'Diajukan',
            'under_review' => 'Sedang Ditinjau',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'in_repair' => 'Dalam Perbaikan',
            'completed' => 'Selesai',
            default => $this->status,
        };
    }
}
