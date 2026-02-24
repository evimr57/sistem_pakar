<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah ENUM untuk tambah 'super_admin'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'user') DEFAULT 'user'");
    }

    public function down(): void
    {
        // Rollback ke ENUM lama
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
    }
};