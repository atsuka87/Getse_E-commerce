<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_images')->delete();
        
        \DB::table('product_images')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 9,
                'image_path' => 'products/ZcwOhmGerb8mtwzFLPYtPKzRQJz7syPFqsKfvQCx.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-30 19:19:56',
                'updated_at' => '2026-05-30 19:19:56',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 5,
                'image_path' => 'products/DLy0hSbKBDKkgFAwBY5dufp6kKGttFE9swT1OKJp.jpg',
                'alt_text' => NULL,
                'is_primary' => 0,
                'sort_order' => 0,
                'created_at' => '2026-05-30 19:24:47',
                'updated_at' => '2026-05-30 19:24:47',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 11,
                'image_path' => 'products/g0BJkR0PUJ5CAdK2jfM34Y8MWE0YWp5v7x9yt50R.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 16:55:33',
                'updated_at' => '2026-05-31 16:55:33',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 12,
                'image_path' => 'products/1I0sGCuIKRRUT218Jq8585Ijyh3Z2YmOgOaRrlyx.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 17:00:18',
                'updated_at' => '2026-05-31 17:00:18',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 13,
                'image_path' => 'products/wa0vz9Twn4P0fTtXLUETz9evcBhzuwmI2MHkhn6V.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 17:03:59',
                'updated_at' => '2026-05-31 17:03:59',
            ),
            5 => 
            array (
                'id' => 6,
                'product_id' => 14,
                'image_path' => 'products/F71DjZO8t54jmjnq36O8gKZFzgurQIUHUEXuFQ6p.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 17:07:21',
                'updated_at' => '2026-05-31 17:07:21',
            ),
            6 => 
            array (
                'id' => 7,
                'product_id' => 15,
                'image_path' => 'products/BGOZvf3P53SOEqnuUYDmiqowxrpntA7xtZa2ZqXR.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:41:02',
                'updated_at' => '2026-05-31 19:41:02',
            ),
            7 => 
            array (
                'id' => 8,
                'product_id' => 16,
                'image_path' => 'products/29U0zum8CoYrk2iDF9Ssx4NIP9nNXijhFJNOHJS9.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:43:40',
                'updated_at' => '2026-05-31 19:43:40',
            ),
            8 => 
            array (
                'id' => 9,
                'product_id' => 17,
                'image_path' => 'products/tJu2nINLlVFeyUPAkdW6Xh7usBgdamd6pJ2ss81e.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:46:28',
                'updated_at' => '2026-05-31 19:46:28',
            ),
            9 => 
            array (
                'id' => 10,
                'product_id' => 18,
                'image_path' => 'products/LPygf4BraRLh8FfzaPOFTeV1Sg5UscDanL3iSo7K.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:48:59',
                'updated_at' => '2026-05-31 19:48:59',
            ),
            10 => 
            array (
                'id' => 11,
                'product_id' => 19,
                'image_path' => 'products/T4jjxfX6jlIjIUGvXV6GW6iV1BQSRBypGFAne5GS.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:50:57',
                'updated_at' => '2026-05-31 19:50:57',
            ),
            11 => 
            array (
                'id' => 12,
                'product_id' => 20,
                'image_path' => 'products/oB1EPtd8aXPUldrHTiPac1ZKXqiE6X6LTMmQpfHF.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-05-31 19:53:27',
                'updated_at' => '2026-05-31 19:53:27',
            ),
            12 => 
            array (
                'id' => 13,
                'product_id' => 21,
                'image_path' => 'products/fFmFZ4T6GCdSbQAa1dVzlejEcXvsFZqv6cPU8oJI.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:38:16',
                'updated_at' => '2026-06-01 07:38:16',
            ),
            13 => 
            array (
                'id' => 14,
                'product_id' => 22,
                'image_path' => 'products/D09JusuRQv6xJJSOMHEIIanpGmMsR1bDm4vbMxnb.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:40:47',
                'updated_at' => '2026-06-01 07:40:47',
            ),
            14 => 
            array (
                'id' => 15,
                'product_id' => 23,
                'image_path' => 'products/5IMJUBqiRjRAjsuBBUwvX1rSNGflKh2KPVFSacbO.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:43:03',
                'updated_at' => '2026-06-01 07:43:03',
            ),
            15 => 
            array (
                'id' => 16,
                'product_id' => 24,
                'image_path' => 'products/JU3tYWBe7WCCMpzYD7Y6U0NDK8VKX6Q0E6ZeEOvK.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:46:47',
                'updated_at' => '2026-06-01 07:46:47',
            ),
            16 => 
            array (
                'id' => 17,
                'product_id' => 25,
                'image_path' => 'products/txUXG9N21bf4m4Bxm2F7DgnmCff2V85H95YHKFXH.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:48:59',
                'updated_at' => '2026-06-01 07:48:59',
            ),
            17 => 
            array (
                'id' => 18,
                'product_id' => 26,
                'image_path' => 'products/bt0gSTireGycX7EfQ9bFGrz1dTTpZytO2trPcmn7.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:50:32',
                'updated_at' => '2026-06-01 07:50:32',
            ),
            18 => 
            array (
                'id' => 19,
                'product_id' => 27,
                'image_path' => 'products/ggpUdOh7oCrN5noUTIIs0AWdei19JmH575pNnHQe.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:52:45',
                'updated_at' => '2026-06-01 07:52:45',
            ),
            19 => 
            array (
                'id' => 20,
                'product_id' => 28,
                'image_path' => 'products/sCruGhk5WmjgPCbnL6DDqUluaMSQh4gxJH166UwA.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:54:30',
                'updated_at' => '2026-06-01 07:54:30',
            ),
            20 => 
            array (
                'id' => 21,
                'product_id' => 29,
                'image_path' => 'products/Lh96e6JGl2tFQ5660NiQPS0Vydx4pBqpbxkljGWZ.jpg',
                'alt_text' => NULL,
                'is_primary' => 1,
                'sort_order' => 0,
                'created_at' => '2026-06-01 07:56:28',
                'updated_at' => '2026-06-01 07:56:28',
            ),
        ));
        
        
    }
}