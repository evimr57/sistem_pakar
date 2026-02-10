<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rule_basis', function (Blueprint $table) {
            $table->id('id_rule');
            $table->string('id_penyakit', 10);
            $table->string('id_gejala', 10);
            $table->decimal('cf_pakar', 3, 2);
            $table->string('keterangan', 200)->nullable();
            $table->timestamps();
            
            // Foreign Keys
            $table->foreign('id_penyakit')
                  ->references('id_penyakit')
                  ->on('master_penyakit')
                  ->onDelete('cascade');
                  
            $table->foreign('id_gejala')
                  ->references('id_gejala')
                  ->on('master_gejala')
                  ->onDelete('cascade');
            
            // Unique Constraint
            $table->unique(['id_penyakit', 'id_gejala']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rule_basis');
    }
};