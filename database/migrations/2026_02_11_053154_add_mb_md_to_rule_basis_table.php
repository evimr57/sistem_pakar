<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rule_basis', function (Blueprint $table) {
            $table->decimal('mb', 3, 2)->after('id_gejala')->comment('Measure of Belief');
            $table->decimal('md', 3, 2)->after('mb')->comment('Measure of Disbelief');
            
            // cf_pakar jadi hasil kalkulasi otomatis (MB - MD)
            // Tapi tetap disimpan untuk performa query
        });
    }

    public function down(): void
    {
        Schema::table('rule_basis', function (Blueprint $table) {
            $table->dropColumn(['mb', 'md']);
        });
    }
};