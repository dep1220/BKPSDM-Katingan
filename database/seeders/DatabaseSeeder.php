<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,      // 1. Jalankan ini untuk membuat roles
            AdminUserSeeder::class, // 2. Tambahkan ini untuk membuat user admin
        ]);
    }
}