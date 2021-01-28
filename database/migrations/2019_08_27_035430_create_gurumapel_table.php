<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGurumapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('t_gurumapel', function (Blueprint $table) {
            $table->Increments('id_gurumapel');
            $table->integer('id_guru')->unsigned();
            $table->foreign('id_guru')->references('id_guru')->on('t_guru')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('t_matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_gurumapel', 'id_guru', 'id_mapel']);
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
        Schema::drop('t_gurumapel', function (Blueprint $table) {
            $table->dropForeign('t_gurumapel_id_thn_ajaran_foreign');
            $table->dropForeign('t_gurumapel_id_guru_foreign');
            $table->dropForeign('t_gurumapel_id_mapel_foreign');
        });

        Schema::dropIfExists('t_gurumapel');
    }
}
