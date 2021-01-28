<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_admin')->insert([
            'username' => 'admin',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
        ]);
    }
}
