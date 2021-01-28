<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswakelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('t_siswakelas', function (Blueprint $table) {
            $table->integer('id_siswakelas')->unsigned();
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id_kelas')->on('t_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id_siswa')->on('t_siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_siswakelas', 'id_kelas', 'id_siswa']);
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
        Schema::drop('t_siswakelas', function (Blueprint $table) {
            $table->dropForeign('t_siswakelas_id_kelas_foreign');
            $table->dropForeign('t_siswakelas_id_siswa_foreign');
            $table->dropForeign('t_siswakelas_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('t_siswakelas');
    }
}
