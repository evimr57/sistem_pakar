<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_diagnosis', function (Blueprint $table) {
            $table->id('id_diagnosis');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('tanggal')->useCurrent();
            
            // Input & Output (JSON)
            $table->json('gejala_input')->nullable();
            $table->json('hasil_diagnosa')->nullable();
            
            $table->decimal('cf_tertinggi', 3, 2)->nullable();
            $table->string('penyakit_final', 10)->nullable();
            
            // Info tambahan
            $table->string('user_info', 100)->nullable();
            $table->string('lokasi', 100)->nullable();
            
            $table->timestamps();
            
            // Foreign Keys
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
                  
            $table->foreign('penyakit_final')
                  ->references('id_penyakit')
                  ->on('master_penyakit')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_diagnosis');
    }
};