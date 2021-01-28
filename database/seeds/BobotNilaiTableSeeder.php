<?php

use Illuminate\Database\Seeder;

class BobotNilaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ketpenilaian_bobotnilai')->insert([
            'id_thn_ajaran' => 1,
            'NUH' => 65,
            'PTS' => 75,
            'PAS' => 80,
            'pembagi' => 4,
        ]);
    }
}
