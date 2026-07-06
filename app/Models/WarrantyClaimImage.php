<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarrantyClaimImage extends Model
{
    protected $fillable = ['warranty_claim_id', 'image_path'];

    public function warrantyClaim()
    {
        return $this->belongsTo(WarrantyClaim::class);
    }
}
