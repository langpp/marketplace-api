<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeterampilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('t_keterampilan', function (Blueprint $table) {
            $table->Increments('id_keterampilan');
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id_siswa')->on('t_siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('t_matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nilai');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_keterampilan', 'id_siswa', 'id_mapel']);
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
        Schema::drop('t_keterampilan', function (Blueprint $table) {
            $table->dropForeign('t_keterampilan_id_siswa_foreign');
            $table->dropForeign('t_keterampilan_id_mapel_foreign');
            $table->dropForeign('t_keterampilan_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('t_keterampilan');
    }
}