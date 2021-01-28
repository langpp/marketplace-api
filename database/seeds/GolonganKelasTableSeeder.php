<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class GolonganKelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_golongan_kelas')->insert([
            'golongan' => 'X',
            'created_at' => Carbon::now(),
        ]);
    }
}
