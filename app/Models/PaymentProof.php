<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    protected $fillable = ['payment_id', 'image_path', 'notes'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
