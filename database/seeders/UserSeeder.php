<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::create([
        //     'nama' => 'Admin',
        //     'email' => 'adminsispak@role.test',
        //     'password' => bcrypt('admin123')
        // ]);

        // $admin->assignRole('admin');

        $dokter = User::create([ 
            'nama' => 'Dokter',
            'email' => 'doktersispak@role.test',
            'password' => bcrypt('dokter123')
        ]);

        $dokter->assignRole('dokter');

        // $user = User::create([
        //     'nama' => 'User',
        //     'email' => 'usersispak@role.test',
        //     'password' => bcrypt('user123')
        // ]);

        // $user->assignRole('user');

    }
}
