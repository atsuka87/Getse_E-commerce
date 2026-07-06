<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin DewiElektro',
                'email' => 'admin@dewielektro.com',
                'email_verified_at' => '2026-05-25 14:48:06',
                'password' => '$2y$12$HrJFzyjx8Gfjg32AzOkB2eXmKG5ekHqQ1bcRaZk7CXk/koBfGf.VO',
                'role' => 'admin',
                'phone' => '628123456789',
                'address' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Budi Customer',
                'email' => 'budi@example.com',
                'email_verified_at' => '2026-05-25 14:48:06',
                'password' => '$2y$12$1VcwJxmCy.8fmuLnqX4XjeITYIcQn7DG/UO3uHXu3gC/twlE0flD6',
                'role' => 'customer',
                'phone' => '628987654321',
                'address' => 'Jl. Merdeka No. 123',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '10110',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2026-05-25 14:48:06',
                'updated_at' => '2026-05-25 14:48:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'deww',
                'email' => 'dewilindautami9@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$sVQ7hSnq4JU7paPsTY8Muu8kObEJIpLJi3Yy9.WpNFiCqrweOq.yS',
                'role' => 'customer',
                'phone' => NULL,
                'address' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2026-05-26 05:19:42',
                'updated_at' => '2026-05-26 05:19:42',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pemilik Sistem',
                'email' => 'pemilik@example.com',
                'email_verified_at' => '2026-06-07 16:22:16',
                'password' => '$2y$12$bIsyag0GeaX4t5wKFfMpLuKBhNQN7gJpOhl3qGWv4RT8G3OIu9T1O',
                'role' => 'pemilik',
                'phone' => NULL,
                'address' => NULL,
                'city' => NULL,
                'province' => NULL,
                'postal_code' => NULL,
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2026-06-07 16:22:16',
                'updated_at' => '2026-06-07 16:22:16',
            ),
        ));
        
        
    }
}