<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['name' => 'Win Mulia Abadi'],
            ['name' => 'Berlian Elektronik'],
            ['name' => 'Stevindo Jaya'],
            ['name' => 'Perdana Sukses'],
            ['name' => 'Svarna Dipa'],
            ['name' => 'Central Elektronik'],
        ];

        foreach ($suppliers as $supplier) {
            \App\Models\Supplier::updateOrCreate(['name' => $supplier['name']], $supplier);
        }
    }
}
