<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::enableForeignKeyConstraints();
    	Schema::create('t_absen', function (Blueprint $table) {
    		$table->Increments('id_absen');
    		$table->integer('id_siswa')->unsigned();
    		$table->foreign('id_siswa')->references('id_siswa')->on('t_siswa')->onDelete('cascade')->onUpdate('cascade');
    		$table->integer('id_thn_ajaran')->unsigned();
    		$table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
    		$table->Integer('jml_sakit');
    		$table->Integer('jml_izin');
    		$table->Integer('jml_alfa');
    		$table->Integer('jml_hadir');
    		$table->timestamps();
    		$table->softDeletes();
    		$table->index(['id_absen', 'id_siswa', 'id_thn_ajaran']);
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::disableForeignKeyConstraints();
    	Schema::drop('t_matapelajaran', function (Blueprint $table) {
    		$table->dropForeign('t_absen_id_siswa_foreign');
    		$table->dropForeign('t_absen_id_thn_ajaran_foreign');
    	});
    	Schema::dropIfExists('t_absen');
    }
}
