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
        // Step 1: Drop foreign key dulu
        $fk1 = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'riwayat_diagnosis' 
            AND CONSTRAINT_NAME = 'riwayat_diagnosis_penyakit_final_foreign' 
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'");
        if (!empty($fk1)) {
            Schema::table('riwayat_diagnosis', function (Blueprint $table) {
                $table->dropForeign('riwayat_diagnosis_penyakit_final_foreign');
            });
        }

        // Step 2: Ubah penyakit_final jadi VARCHAR(10) supaya cocok dengan id_penyakit
        DB::statement('ALTER TABLE riwayat_diagnosis MODIFY penyakit_final VARCHAR(10) NULL');

        // Step 3: Pasang foreign key lagi
        Schema::table('riwayat_diagnosis', function (Blueprint $table) {
            $table->foreign('penyakit_final')
                ->references('id_penyakit')
                ->on('master_penyakit')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_diagnosis', function (Blueprint $table) {
            $table->dropForeign('riwayat_diagnosis_penyakit_final_foreign');
        });

        DB::statement('ALTER TABLE riwayat_diagnosis MODIFY penyakit_final BIGINT UNSIGNED NULL');
    }
};