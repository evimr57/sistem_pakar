<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RuleBasis;
use Illuminate\Support\Facades\DB;

class RuleBasisSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        RuleBasis::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Data dengan MB & MD
        $data = [
            // HP001 - Penggerek Buah Kopi
            [
                'id_penyakit' => 'HP001',
                'id_gejala' => 'G001',
                'mb' => 0.95,           // ← TAMBAH INI
                'md' => 0.05,           // ← TAMBAH INI
                // cf_pakar akan otomatis = 0.95 - 0.05 = 0.90
                'keterangan' => 'Gejala sangat khas',
            ],
            [
                'id_penyakit' => 'HP001',
                'id_gejala' => 'G002',
                'mb' => 0.75,           // ← TAMBAH INI
                'md' => 0.05,           // ← TAMBAH INI
                // cf_pakar = 0.75 - 0.05 = 0.70
                'keterangan' => 'Gejala khas',
            ],
            [
                'id_penyakit' => 'HP001',
                'id_gejala' => 'G003',
                'mb' => 0.90,           // ← TAMBAH INI
                'md' => 0.05,           // ← TAMBAH INI
                // cf_pakar = 0.90 - 0.05 = 0.85
                'keterangan' => 'Gejala sangat khas',
            ],
            
            // HP002 - Penggerek Batang Merah
            [
                'id_penyakit' => 'HP002',
                'id_gejala' => 'G004',
                'mb' => 0.85,
                'md' => 0.05,
                'keterangan' => 'Gejala khas',
            ],
            [
                'id_penyakit' => 'HP002',
                'id_gejala' => 'G005',
                'mb' => 0.80,
                'md' => 0.05,
                'keterangan' => 'Gejala khas',
            ],
            
            // ... tambahkan semua rule dengan MB & MD
        ];

        foreach ($data as $item) {
            RuleBasis::create($item);
        }
    }
}