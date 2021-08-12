<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'dokter',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
    }
}
