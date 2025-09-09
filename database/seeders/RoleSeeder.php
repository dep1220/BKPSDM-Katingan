<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions
        Permission::firstOrCreate(['name' => 'manage news']);
        Permission::firstOrCreate(['name' => 'manage gallery']);
        Permission::firstOrCreate(['name' => 'manage downloads']);
        Permission::firstOrCreate(['name' => 'manage contacts']);
        Permission::firstOrCreate(['name' => 'manage hero']);
        Permission::firstOrCreate(['name' => 'manage officials']); // Ini untuk Pejabat
        Permission::firstOrCreate(['name' => 'manage users']);

        // Buat Roles
        $penulisRole = Role::firstOrCreate(['name' => 'penulis']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'super-admin']); // Super-admin tidak perlu permission manual

        // Berikan Permission ke Role 'penulis'
        $penulisRole->givePermissionTo('manage news');

        // Berikan Permission ke Role 'admin'
        $adminRole->givePermissionTo([
            'manage news',
            'manage gallery',
            'manage downloads',
            'manage contacts',
            'manage hero',
            'manage officials', // Tambahkan permission untuk mengelola pejabat
        ]);
    }
}
