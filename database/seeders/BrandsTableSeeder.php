<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 9,
                'name' => 'Sony',
                'slug' => 'sony',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            1 => 
            array (
                'id' => 10,
                'name' => 'JBL',
                'slug' => 'jbl',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            2 => 
            array (
                'id' => 11,
                'name' => 'LG',
                'slug' => 'lg',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            3 => 
            array (
                'id' => 15,
                'name' => 'Sharp',
                'slug' => 'sharp',
                'logo' => 'brands/FevUi3Hdp8kluOLYfQuBl3uXWzqjpTz9Q3ZfTkh4.jpg',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-05-30 15:00:21',
                'updated_at' => '2026-05-30 15:00:21',
            ),
            4 => 
            array (
                'id' => 16,
                'name' => 'Polytron',
                'slug' => 'polytron',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-05-31 19:44:22',
                'updated_at' => '2026-05-31 19:44:22',
            ),
            5 => 
            array (
                'id' => 17,
                'name' => 'National',
                'slug' => 'national',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-01 07:15:49',
                'updated_at' => '2026-06-01 07:15:49',
            ),
            6 => 
            array (
                'id' => 18,
                'name' => 'Cosmos',
                'slug' => 'cosmos',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-01 07:15:59',
                'updated_at' => '2026-06-01 07:15:59',
            ),
            7 => 
            array (
                'id' => 19,
                'name' => 'Philips',
                'slug' => 'philips',
                'logo' => NULL,
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-06-01 07:45:04',
                'updated_at' => '2026-06-01 07:45:04',
            ),
        ));
        
        
    }
}