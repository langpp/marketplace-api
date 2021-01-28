<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AdminTableSeeder');
        $this->call('TahunAjaranTableSeeder');
        $this->call('SekolahTableSeeder');
        $this->call('GuruTableSeeder');
        $this->call('GolonganKelasTableSeeder');
        $this->call('KelasTableSeeder');
        $this->call('WaliKelasTableSeeder');
        $this->call('MatapelajaranTableSeeder');
        $this->call('BobotNilaiTableSeeder');
    }
}
