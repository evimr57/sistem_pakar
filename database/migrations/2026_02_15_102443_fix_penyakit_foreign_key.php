<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Drop foreign key constraint sementara
        Schema::table('riwayat_diagnosis', function (Blueprint $table) {
            $table->dropForeign('riwayat_diagnosis_penyakit_final_foreign');
        });

        // Step 2: Set id_penyakit jadi AUTO_INCREMENT
        DB::statement('ALTER TABLE master_penyakit MODIFY id_penyakit BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Step 3: Ubah penyakit_final dari VARCHAR(10) jadi BIGINT UNSIGNED
        DB::statement('ALTER TABLE riwayat_diagnosis MODIFY penyakit_final BIGINT UNSIGNED NULL');

        // Step 4: Buat foreign key lagi dengan tipe data yang benar
        Schema::table('riwayat_diagnosis', function (Blueprint $table) {
            $table->foreign('penyakit_final')
                  ->references('id_penyakit')
                  ->on('master_penyakit')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: Drop foreign key
        Schema::table('riwayat_diagnosis', function (Blueprint $table) {
            $table->dropForeign(['penyakit_final']);
        });

        // Kembalikan penyakit_final jadi VARCHAR(10)
        DB::statement('ALTER TABLE riwayat_diagnosis MODIFY penyakit_final VARCHAR(10) NULL');

        // Hapus AUTO_INCREMENT dari id_penyakit
        DB::statement('ALTER TABLE master_penyakit MODIFY id_penyakit BIGINT UNSIGNED NOT NULL');

        // Buat foreign key lagi ke kode_penyakit (struktur lama)
        // Note: Ini opsional, sesuaikan dengan struktur database awal kamu
    }
};