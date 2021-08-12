<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dokter = Dokter::create([
            'kd_dokter' => 'DK-001',
            'nama' => 'Dr.Randy Setiawan',
            'nip' => 1234567891234567,
            'foto' => 'gambar.png',
            'email' => 'dokterrandy@gmail.com',
            'password' => bcrypt('dokter123')
        ]);

        $dokter->assignRole('dokter');
    }
}
