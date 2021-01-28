<?php

use Illuminate\Database\Seeder;

class SekolahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_sekolah')->insert([
            'npsn' => str_random(10),
            'nis' => str_random(10),
            'nama_sekolah' => str_random(10),
            'alamat_sekolah' => str_random(10),
            'kelurahan' => str_random(10),
            'kecamatan' => str_random(10),
            'kabkot' => str_random(10),
            'provinsi' => str_random(10),
            'kodepos' => 1234,
            'no_telepon' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'website' => str_random(10),
            'nama_kepsek' => str_random(10),
            'nip_kepsek' => str_random(10),
            'ttd' => str_random(10),
        ]);
    }
}
