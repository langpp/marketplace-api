<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_siswa', function (Blueprint $table) {
            $table->Increments('id_siswa');
            $table->string('nisn', 40);
            $table->string('nama_siswa', 100);
    		$table->string('nama_ibu', 100);
    		$table->string('nama_ayah', 100);
    		$table->string('nama_wali_murid', 100);
    		$table->year('thn_masuk');
    		$table->string('jenis_kelamin', 20);
    		$table->text('foto');
    		$table->string('username', 40)->unique();
    		$table->string('password', 16);
    		$table->string('agama', 40);
    		$table->timestamps();
            $table->softDeletes();
    		$table->index(['id_siswa', 'username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_siswa');
    }
}
