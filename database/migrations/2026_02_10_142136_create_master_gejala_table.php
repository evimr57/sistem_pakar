<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_gejala', function (Blueprint $table) {
            $table->string('id_gejala', 10)->primary();
            $table->text('nama_gejala');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_gejala');
    }
};