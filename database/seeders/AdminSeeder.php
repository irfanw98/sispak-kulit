<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin =  Admin::create([
            'nama' => 'Admin',
            'username' => 'admin123',
            'email' => 'adminsispak@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        $admin->assignRole('admin');
    }
}
