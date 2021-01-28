<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sekolah', function (Blueprint $table) {
            $table->Increments('id_sekolah');
            $table->string('npsn', 40);
            $table->string('nis', 40);
    		$table->string('nama_sekolah', 200);
    		$table->text('alamat_sekolah');
    		$table->string('kelurahan', 100);
    		$table->string('kecamatan', 100);
    		$table->string('kabkot', 100);
    		$table->string('provinsi', 100);
    		$table->integer('kodepos');
    		$table->string('no_telepon', 13)->unique();
    		$table->string('email', 40)->unique();
    		$table->string('website', 40);
    		$table->string('nama_kepsek', 40);
    		$table->string('nip_kepsek', 40);
    		$table->string('ttd', 255);
    		$table->timestamps();
            $table->softDeletes();
    		$table->index(['id_sekolah', 'no_telepon', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_sekolah');
    }
}
