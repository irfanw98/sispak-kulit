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
        $user = User::create([
            'nama' => 'Irfan Wahyudi',
            'username' => 'irfanw98',
            'jenis_kelamin' => 'L',
            'tgl_lahir' => '1998-11-04',
            'alamat' => 'Jl.Bumi 1 D.19.No.5',
            'email' => 'irfanwahyudi2016@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $user->assignRole('user');

        // $admin = Admin::create([
        //     'nama' => 'Admin',
        //     'username' => 'admin123', 
        //     'email' => 'adminsispak@gmail.com', 
        //     'password' => bcrypt('admin123')
        // ]);

        // $admin->assignRole('admin');

        // $dokter = Dokter::create([
        //     'kd_dokter' => 'KD123',
        //     'nama' => 'Dr.Siska',
        //     'nip' => 12345678,
        //     'foto' => 'siska.jpg',
        //     'email' => 'doktersiska@gmail.com',
        //     'password' => bcrypt('dokter123')
        // ]);

        // $dokter->assignRole('dokter');
    }
}
