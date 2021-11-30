<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $p_masuk = Permission::create(['name' => 'manage barang masuk']);
        $p_keluar = Permission::create(['name' => 'manage barang keluar']);
        $p_lap = Permission::create(['name' => 'view laporan']);

        //gudang
        $gudang = Role::create(['name' => 'staff gudang']);
        $gudang->givePermissionTo($p_masuk, $p_keluar);
        //admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($p_masuk, $p_keluar, $p_lap);

        $superadmin = Role::create(['name' => 'superadmin']);
    }
}
