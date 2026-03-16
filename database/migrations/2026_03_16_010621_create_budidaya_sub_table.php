<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budidaya_sub', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_artikel')->constrained('informasi_budidaya')->onDelete('cascade');
            $table->string('judul_sub');
            $table->longText('konten')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budidaya_sub');
    }
};
