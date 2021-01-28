<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('t_kelas', function (Blueprint $table) {
            $table->Increments('id_kelas');
            $table->string('nama_kelas', 100);
            $table->string('keterangan', 100);
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_golongan')->unsigned();
            $table->foreign('id_golongan')->references('id_golongan')->on('t_golongan_kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_kelas', 'id_thn_ajaran', 'id_golongan']);
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
        Schema::drop('t_kelas', function (Blueprint $table) {
            $table->dropForeign('t_kelas_id_thn_ajaran_foreign');
            $table->dropForeign('t_kelas_id_golongan_foreign');
        });
        Schema::dropIfExists('t_kelas');
    }
}
