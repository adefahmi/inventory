<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123456'),
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
        ]);

        $gudang = User::create([
            'name' => 'Staff Gudang',
            'email' => 'gudang@example.com',
            'password' => Hash::make('123456'),
        ]);

        $superadmin->assignRole('superadmin');
        $admin->assignRole('admin');
        $gudang->assignRole('staff gudang');
    }
}
