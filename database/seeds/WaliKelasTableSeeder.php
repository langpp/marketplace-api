<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class WaliKelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_walikelas')->insert([
            'id_kelas' => 1,
            'id_guru' => 1,
            'id_thn_ajaran' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
