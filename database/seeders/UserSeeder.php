<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate data lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Data baru
        $users = [
            [
                'username' => 'admin',
                'nama' => 'Administrator',
                'email' => 'admin@budidayakopi.com',
                'no_hp' => '081234567890',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'username' => 'petani_andi',
                'nama' => 'Andi Saputra',
                'email' => 'andi@gmail.com',
                'no_hp' => '081987654321',
                'role' => 'user',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}