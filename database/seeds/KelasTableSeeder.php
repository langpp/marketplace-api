<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_kelas')->insert([
            'nama_kelas' => 'X-A',
            'keterangan' => '',
            'id_golongan' => 1,
            'id_thn_ajaran' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
