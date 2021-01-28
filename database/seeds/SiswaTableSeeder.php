<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('t_siswa')->insert([
            'nisn' => 123456765432,
            'nama_siswa' => 'Ariel Peterpan',
            'nama_ibu' => 'Ani',
            'nama_ayah' => 'Nurdin',
            'nama_wali_murid' => 'Nuridn',
            'thn_masuk' => 2017,
            'jenis_kelamin' => 'Laki-Laki',
            'foto' => str_random(10),
            'username' => 'siswa1',
            'password' => Hash::make('1234567890'),
            'agama' => 'islam',
            'created_at' => Carbon::now(),
        ]);
    }
}
