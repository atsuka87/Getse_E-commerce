<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ShippingMethod::create([
            'name' => 'JNE Reguler',
            'cost' => 15000,
            'is_active' => true,
        ]);

        \App\Models\ShippingMethod::create([
            'name' => 'J&T Express',
            'cost' => 14000,
            'is_active' => true,
        ]);

        \App\Models\ShippingMethod::create([
            'name' => 'SiCepat REG',
            'cost' => 16000,
            'is_active' => true,
        ]);
        
        \App\Models\ShippingMethod::create([
            'name' => 'Ambil di Toko',
            'cost' => 0,
            'is_active' => true,
        ]);
    }
}
