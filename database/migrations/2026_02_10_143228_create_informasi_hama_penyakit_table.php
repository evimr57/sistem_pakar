<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_hama_penyakit', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke master_penyakit (opsional)
            $table->string('id_penyakit', 10)->nullable();
            
            // Konten
            $table->string('judul', 200);
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('konten');
            
            // Media
            $table->string('gambar_utama', 255)->nullable();
            $table->json('galeri_gambar')->nullable();
            $table->string('file_pdf', 255)->nullable();
            
            // Kategori
            $table->enum('jenis', ['Hama', 'Penyakit']);
            $table->json('tags')->nullable();
            
            // Info Tambahan Khusus
            $table->text('gejala_visual')->nullable();
            $table->text('cara_identifikasi')->nullable();
            $table->text('pencegahan')->nullable();
            $table->text('pengendalian')->nullable();
            
            // Metadata
            $table->integer('urutan')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            
            // Author
            $table->unsignedBigInteger('created_by')->nullable();
            
            $table->timestamps();
            
            // Foreign Keys
            $table->foreign('id_penyakit')
                  ->references('id_penyakit')
                  ->on('master_penyakit')
                  ->onDelete('set null');
                  
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            
            // Indexes
            $table->index('jenis');
            $table->index('is_published');
            $table->index('urutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_hama_penyakit');
    }
};