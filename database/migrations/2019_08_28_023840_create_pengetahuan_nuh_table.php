<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengetahuanNuhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('t_pengetahuan_nuh', function (Blueprint $table) {
            $table->integer('id_nuh')->unsigned();
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id_siswa')->on('t_siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('t_matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->Integer('nuh1');
            $table->Integer('nuh2');
            $table->Integer('nuh3');
            $table->Integer('nuh4');
            $table->Integer('nuh5');
            $table->Integer('nuh6');
            $table->Integer('nuh7');
            $table->Integer('nuh8');
            $table->Integer('nuh9');
            $table->Integer('nuh10');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_nuh', 'id_siswa', 'id_thn_ajaran']);
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
        Schema::drop('t_pengetahuan_nuh', function (Blueprint $table) {
            $table->dropForeign('t_pengetahuan_nuh_id_thn_ajaran_foreign');
            $table->dropForeign('t_pengetahuan_nuh_id_siswa_foreign');
            $table->dropForeign('t_pengetahuan_nuh_id_mapel_foreign');
        });
        Schema::dropIfExists('t_pengetahuan_nuh');
    }
}
