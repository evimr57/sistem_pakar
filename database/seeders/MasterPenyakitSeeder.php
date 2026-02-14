<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterPenyakit;
use Illuminate\Support\Facades\DB;

class MasterPenyakitSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // STEP 1: TRUNCATE (Hapus data lama)
        // ============================================
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Nonaktifkan foreign key check
        MasterPenyakit::truncate();                   // Hapus semua data
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');   // Aktifkan kembali
        
        // ============================================
        // STEP 2: INSERT data baru
        // ============================================
        
        $data = [
            [
                'id_penyakit' => 'HP001',
                'nama_penyakit' => 'Penggerek Buah Kopi',
                'nama_latin' => 'Hypothenemus hampei',
                'kategori' => 'Hama',
                'deskripsi_singkat' => 'Hama PBKo menyerang semua jenis kopi dengan menggerek buah.',
                'tingkat_bahaya' => 'Sangat Tinggi',
            ],
            [
                'id_penyakit' => 'HP002',
                'nama_penyakit' => 'Penggerek Batang Merah',
                'nama_latin' => 'Zeuzera coffeae',
                'kategori' => 'Hama',
                'deskripsi_singkat' => 'Larva menggerek batang kopi dari dalam.',
                'tingkat_bahaya' => 'Tinggi',
            ],
            // ... tambahkan semua data
        ];

        foreach ($data as $item) {
            MasterPenyakit::create($item);
        }
    }
}