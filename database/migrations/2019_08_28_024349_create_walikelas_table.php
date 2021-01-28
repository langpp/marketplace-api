<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalikelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('t_walikelas', function (Blueprint $table) {
            $table->Increments('id_walikelas');
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id_kelas')->on('t_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_guru')->unsigned();
            $table->foreign('id_guru')->references('id_guru')->on('t_guru')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_walikelas', 'id_kelas', 'id_guru']);
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
        Schema::drop('t_walikelas', function (Blueprint $table) {
            $table->dropForeign('t_walikelas_id_thn_ajaran_foreign');
            $table->dropForeign('t_walikelas_id_mapel_foreign');
            $table->dropForeign('t_walikelas_id_golongan_foreign');
        });
        Schema::dropIfExists('t_walikelas');
    }
}
