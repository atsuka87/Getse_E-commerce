<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilikUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'pemilik@example.com'],
            [
                'name' => 'Pemilik Sistem',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'pemilik',
                'email_verified_at' => now(),
            ]
        );
    }
}
