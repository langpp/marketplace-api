<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatapelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::enableForeignKeyConstraints();

        Schema::create('t_matapelajaran', function (Blueprint $table) {
            $table->Increments('id_mapel');
            $table->string('nama_mapel', 40);
            $table->string('keterangan', 40);
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kelompok', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_mapel', 'id_thn_ajaran']);
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
            $table->dropForeign('t_matapelajaran_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('t_matapelajaran');
    }
}
