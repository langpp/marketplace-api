<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class GuruTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_guru')->insert([[
            'nip_guru' => 123456765432,
            'nama_guru' => 'Ariel Peterpan',
            'thn_masuk' => 2018,
            'pendidikan' => 'S1',
            'gender' => 'Laki-Laki',
            'jabatan' => 'PNS',
            'username' => 'guru',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
        ],
        [
            'nip_guru' => 123456768907,
            'nama_guru' => 'Ariel Peterpan',
            'thn_masuk' => 2018,
            'pendidikan' => 'S1',
            'gender' => 'Laki-Laki',
            'jabatan' => 'PNS',
            'username' => 'guru2',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
        ]]);
    }
}
