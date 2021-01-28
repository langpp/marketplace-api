<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MatapelajaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_matapelajaran')->insert([
            'nama_mapel' => 'Matematika',
            'keterangan' => '',
            'id_thn_ajaran' => 1,
            'kelompok' => 'Kelompok A',
            'created_at' => Carbon::now(),
        ]);
    }
}
