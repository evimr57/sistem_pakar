<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // URUTAN PENTING! Parent dulu, Child terakhir
        $this->call([
            UserSeeder::class,              // ← Independen (boleh duluan)
            MasterPenyakitSeeder::class,    // ← Parent 1 (harus duluan)
            MasterGejalaSeeder::class,      // ← Parent 2 (harus duluan)
            RuleBasisSeeder::class,         // ← Child (terakhir, setelah parent ada)
            // InformasiBudidayaSeeder::class,  // ← Kalau sudah ada
            // InformasiHamaPenyakitSeeder::class,  // ← Kalau sudah ada
        ]);
    }
}