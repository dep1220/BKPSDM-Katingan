<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari role 'super-admin' yang sudah dibuat oleh RoleSeeder
        $superAdminRole = Role::where('name', 'super-admin')->first();

        // Buat user super-admin jika role-nya ada
        if ($superAdminRole) {
            $superAdminUser = User::firstOrCreate(
                ['email' => 'superadmin@example.com'], // Kunci untuk mencari
                [
                    'name' => 'Super Administrator',
                    'password' => Hash::make('Papski3690'), // Ganti dengan password yang aman
                ]
            );

            // Berikan role 'super-admin' ke user tersebut
            $superAdminUser->assignRole($superAdminRole);
        }
    }
}