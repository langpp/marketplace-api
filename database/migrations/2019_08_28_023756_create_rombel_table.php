<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRombelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::enableForeignKeyConstraints();
        Schema::create('t_rombel', function (Blueprint $table) {
            $table->integer('id_rombel')->unsigned();
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id_kelas')->on('t_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_mapel')->unsigned();
            $table->foreign('id_mapel')->references('id_mapel')->on('t_matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_rombel', 'id_kelas', 'id_mapel']);
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
        Schema::drop('t_rombel', function (Blueprint $table) {
            $table->dropForeign('t_rombel_id_kelas_foreign');
            $table->dropForeign('t_rombel_id_mapel_foreign');
            $table->dropForeign('t_rombel_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('t_rombel');
    }
}
