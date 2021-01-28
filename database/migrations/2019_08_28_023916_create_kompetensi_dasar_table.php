<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKompetensiDasarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('t_kompetensi_dasar', function (Blueprint $table) {
            $table->integer('id_kd')->unsigned();
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('t_matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->text('k3');
            $table->text('k4');
            $table->integer('id_golongan')->unsigned();
            $table->foreign('id_golongan')->references('id_golongan')->on('t_golongan_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_kd', 'id_thn_ajaran', 'id_mapel']);
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
        Schema::drop('t_kompetensi_dasar', function (Blueprint $table) {
            $table->dropForeign('t_kompetensi_dasar_id_thn_ajaran_foreign');
            $table->dropForeign('t_kompetensi_dasar_id_mapel_foreign');
            $table->dropForeign('t_kompetensi_dasar_id_golongan_foreign');
        });
        Schema::dropIfExists('t_kompetensi_dasar');
    }
}
