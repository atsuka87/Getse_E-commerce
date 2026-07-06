<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSpecsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_specs')->delete();
        
        \DB::table('product_specs')->insert(array (
            0 => 
            array (
                'id' => 36,
                'product_id' => 6,
                'spec_key' => 'Ukuran Layar',
                'spec_value' => '55 inci',
                'sort_order' => 0,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            1 => 
            array (
                'id' => 37,
                'product_id' => 6,
                'spec_key' => 'Resolusi',
            'spec_value' => '4K UHD (3840x2160)',
                'sort_order' => 1,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            2 => 
            array (
                'id' => 38,
                'product_id' => 6,
                'spec_key' => 'Panel',
                'spec_value' => 'Crystal UHD',
                'sort_order' => 2,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            3 => 
            array (
                'id' => 39,
                'product_id' => 6,
                'spec_key' => 'Prosesor',
                'spec_value' => 'Crystal Processor 4K',
                'sort_order' => 3,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            4 => 
            array (
                'id' => 40,
                'product_id' => 6,
                'spec_key' => 'HDR',
                'spec_value' => 'HDR10+',
                'sort_order' => 4,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            5 => 
            array (
                'id' => 41,
                'product_id' => 6,
                'spec_key' => 'Smart TV',
                'spec_value' => 'Tizen OS',
                'sort_order' => 5,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            6 => 
            array (
                'id' => 42,
                'product_id' => 6,
                'spec_key' => 'Koneksi',
                'spec_value' => 'HDMI x3, USB x1, Wi-Fi',
                'sort_order' => 6,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            7 => 
            array (
                'id' => 43,
                'product_id' => 7,
                'spec_key' => 'Output',
                'spec_value' => '30W',
                'sort_order' => 0,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            8 => 
            array (
                'id' => 44,
                'product_id' => 7,
                'spec_key' => 'Bluetooth',
                'spec_value' => '5.1',
                'sort_order' => 1,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            9 => 
            array (
                'id' => 45,
                'product_id' => 7,
                'spec_key' => 'Tahan Air',
                'spec_value' => 'IP67',
                'sort_order' => 2,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            10 => 
            array (
                'id' => 46,
                'product_id' => 7,
                'spec_key' => 'Baterai',
                'spec_value' => '12 jam',
                'sort_order' => 3,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            11 => 
            array (
                'id' => 47,
                'product_id' => 7,
                'spec_key' => 'Berat',
                'spec_value' => '550g',
                'sort_order' => 4,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            12 => 
            array (
                'id' => 48,
                'product_id' => 7,
                'spec_key' => 'PartyBoost',
                'spec_value' => 'Ya',
                'sort_order' => 5,
                'created_at' => '2026-05-25 14:48:07',
                'updated_at' => '2026-05-25 14:48:07',
            ),
            13 => 
            array (
                'id' => 56,
                'product_id' => 5,
                'spec_key' => 'Driver',
                'spec_value' => '30mm',
                'sort_order' => 0,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            14 => 
            array (
                'id' => 57,
                'product_id' => 5,
                'spec_key' => 'Tipe',
                'spec_value' => 'Over-ear, Closed-back',
                'sort_order' => 1,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            15 => 
            array (
                'id' => 58,
                'product_id' => 5,
                'spec_key' => 'Koneksi',
                'spec_value' => 'Bluetooth 5.2, 3.5mm',
                'sort_order' => 2,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            16 => 
            array (
                'id' => 59,
                'product_id' => 5,
                'spec_key' => 'ANC',
                'spec_value' => 'Ya, Auto NC Optimizer',
                'sort_order' => 3,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            17 => 
            array (
                'id' => 60,
                'product_id' => 5,
                'spec_key' => 'Baterai',
                'spec_value' => '30 jam',
                'sort_order' => 4,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            18 => 
            array (
                'id' => 61,
                'product_id' => 5,
                'spec_key' => 'Berat',
                'spec_value' => '250g',
                'sort_order' => 5,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            19 => 
            array (
                'id' => 62,
                'product_id' => 5,
                'spec_key' => 'Fitur',
                'spec_value' => 'LDAC, Multipoint, Speak-to-Chat',
                'sort_order' => 6,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
        ));
        
        
    }
}