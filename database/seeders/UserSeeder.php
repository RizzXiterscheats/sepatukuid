<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua user lama jika ada
        User::truncate();
        
        // Admin - password plain text "admin123"
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sepatuku.id',
            'password' => 'admin123', // TIDAK DI-HASH
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Petugas - password plain text "petugas123"
        User::create([
            'name' => 'Petugas Toko',
            'email' => 'petugas@sepatuku.id',
            'password' => 'petugas123', // TIDAK DI-HASH
            'role' => 'petugas',
            'phone' => '081987654321',
            'address' => 'Jl. Petugas No. 2, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Customer - password plain text "customer123"
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@sepatuku.id',
            'password' => 'customer123', // TIDAK DI-HASH
            'role' => 'user',
            'phone' => '081111111111',
            'address' => 'Jl. Customer No. 3, Jakarta',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        
        echo "Users created with plain text passwords (for testing only)!\n";
        echo "Admin: admin@sepatuku.id / admin123\n";
        echo "Petugas: petugas@sepatuku.id / petugas123\n";
        echo "Customer: customer@sepatuku.id / customer123\n";
    }
}