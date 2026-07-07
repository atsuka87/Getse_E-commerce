<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_methods')->delete();
        
        \DB::table('shipping_methods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dalam Kota',
                'cost' => '15000.00',
                'is_active' => 1,
                'created_at' => '2026-06-16 22:33:54',
                'updated_at' => '2026-07-05 12:53:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Luar Kota',
                'cost' => '25000.00',
                'is_active' => 1,
                'created_at' => '2026-06-16 22:33:54',
                'updated_at' => '2026-07-05 12:54:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'JNE Reguler',
                'cost' => '15000.00',
                'is_active' => 1,
                'created_at' => '2026-07-07 19:37:51',
                'updated_at' => '2026-07-07 19:37:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'J&T Express',
                'cost' => '14000.00',
                'is_active' => 1,
                'created_at' => '2026-07-07 19:37:51',
                'updated_at' => '2026-07-07 19:37:51',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'SiCepat REG',
                'cost' => '16000.00',
                'is_active' => 1,
                'created_at' => '2026-07-07 19:37:51',
                'updated_at' => '2026-07-07 19:37:51',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ambil di Toko',
                'cost' => '0.00',
                'is_active' => 1,
                'created_at' => '2026-07-07 19:37:51',
                'updated_at' => '2026-07-07 19:37:51',
            ),
        ));
        
        
    }
}