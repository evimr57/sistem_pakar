<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_penyakit', function (Blueprint $table) {
            $table->string('id_penyakit', 10)->primary();
            $table->string('nama_penyakit', 200);
            $table->string('nama_latin', 200)->nullable();
            $table->enum('kategori', ['Hama', 'Penyakit']);
            
            // Deskripsi
            $table->text('deskripsi_singkat')->nullable();
            $table->text('deskripsi_lengkap')->nullable();
            
            // Pengendalian/Solusi
            $table->text('pengendalian_pencegahan')->nullable();
            $table->text('pengendalian_kimia')->nullable();
            $table->text('pengendalian_organik')->nullable();
            $table->text('pengendalian_budidaya')->nullable();
            
            // Metadata
            $table->enum('tingkat_bahaya', ['Rendah', 'Sedang', 'Tinggi', 'Sangat Tinggi'])->nullable();
            $table->string('gambar_url', 255)->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_penyakit');
    }
};