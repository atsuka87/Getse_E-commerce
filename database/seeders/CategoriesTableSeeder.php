<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'TV & Monitor',
                'slug' => 'tv-monitor',
                'description' => 'Smart TV dan monitor berkualitas',
                'icon' => '📺',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Speaker',
                'slug' => 'speaker',
                'description' => 'Speaker, earphone, dan headphone',
                'icon' => '🔊',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-30 14:53:25',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Charger, casing, dan aksesoris lainnya',
                'icon' => '🔌',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 5,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            3 => 
            array (
                'id' => 9,
                'name' => 'Kulkas',
                'slug' => 'kulkas',
                'description' => NULL,
                'icon' => '❄️',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-30 14:45:57',
                'updated_at' => '2026-05-30 14:45:57',
            ),
            4 => 
            array (
                'id' => 10,
                'name' => 'mesin cuci',
                'slug' => 'mesin-cuci',
                'description' => NULL,
                'icon' => '🎛️',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-30 14:50:01',
                'updated_at' => '2026-05-30 14:50:01',
            ),
            5 => 
            array (
                'id' => 11,
                'name' => 'blender',
                'slug' => 'blender',
                'description' => NULL,
                'icon' => '🍹',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-30 14:51:18',
                'updated_at' => '2026-05-30 14:51:18',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => 'dispenser',
                'slug' => 'dispenser',
                'description' => NULL,
                'icon' => '💧',
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-30 14:52:27',
                'updated_at' => '2026-05-30 14:52:27',
            ),
            7 => 
            array (
                'id' => 13,
                'name' => 'Rice Cooker',
                'slug' => 'rice-cooker',
                'description' => NULL,
                'icon' => NULL,
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:30:56',
                'updated_at' => '2026-06-01 07:30:56',
            ),
            8 => 
            array (
                'id' => 14,
                'name' => 'Setrika',
                'slug' => 'setrika',
                'description' => NULL,
                'icon' => NULL,
                'image' => NULL,
                'is_active' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:43:52',
                'updated_at' => '2026-06-01 07:43:52',
            ),
        ));
        
        
    }
}