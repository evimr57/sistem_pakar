<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_budidaya', function (Blueprint $table) {
            $table->id();
            
            // Konten
            $table->string('judul', 200);
            $table->string('slug')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('konten');
            
            // Media
            $table->string('gambar_utama', 255)->nullable();
            $table->json('galeri_gambar')->nullable();
            $table->string('file_pdf', 255)->nullable();
            
            // Kategori/Tag
            $table->string('kategori', 50)->nullable();
            $table->json('tags')->nullable();
            
            // Metadata
            $table->integer('urutan')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            
            // Author
            $table->unsignedBigInteger('created_by')->nullable();
            
            $table->timestamps();
            
            // Foreign Key
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            
            // Indexes
            $table->index('kategori');
            $table->index('is_published');
            $table->index('urutan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_budidaya');
    }
};