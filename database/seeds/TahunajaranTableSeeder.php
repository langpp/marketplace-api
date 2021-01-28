<?php

use Illuminate\Database\Seeder;

class TahunAjaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_tahun_ajaran')->insert([
            'tahun_ajaran' => "2019/2020",
            'semester' => 1,
            'status' => 1,
        ]);
    }
}
