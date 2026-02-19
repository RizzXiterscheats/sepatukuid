<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        User::truncate();

        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sepatukuid.com',
            'password' => 'admin123', // PLAIN TEXT
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas Customer Service',
            'email' => 'petugas@sepatukuid.com',
            'password' => 'petugas123', // PLAIN TEXT
            'role' => 'petugas',
            'phone' => '081234567891',
            'address' => 'Bandung, Indonesia',
        ]);

        // User biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@sepatukuid.com',
            'password' => 'user123', // PLAIN TEXT
            'role' => 'user',
            'phone' => '081234567892',
            'address' => 'Surabaya, Indonesia',
        ]);

        // User tambahan
        User::create([
            'name' => 'Raki Aranda',
            'email' => 'raki@example.com',
            'password' => 'raki123', // PLAIN TEXT
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@example.com',
            'password' => 'andi123', // PLAIN TEXT
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Sinta Wijaya',
            'email' => 'sinta@example.com',
            'password' => 'sinta123', // PLAIN TEXT
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => 'budi123', // PLAIN TEXT
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Cici Amelia',
            'email' => 'cici@example.com',
            'password' => 'cici123', // PLAIN TEXT
            'role' => 'user',
        ]);

        $this->command->info('========================================');
        $this->command->info('DATABASE SEEDER BERHASIL!');
        $this->command->info('========================================');
        $this->command->info('Admin   : admin@sepatukuid.com / admin123');
        $this->command->info('Petugas : petugas@sepatukuid.com / petugas123');
        $this->command->info('User    : user@sepatukuid.com / user123');
        $this->command->info('========================================');
    }
}