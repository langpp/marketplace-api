<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndikatorSikapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('t_indikator_sikap', function (Blueprint $table) {
            $table->Increments('id_indikator_sikap');
            $table->integer('no_urut');
            $table->text('indikator');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_indikator_sikap', 'id_thn_ajaran']);
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
        Schema::drop('t_indikator_sikap', function (Blueprint $table) {
            $table->dropForeign('t_indikator_sikap_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('t_indikator_sikap');
    }
}
