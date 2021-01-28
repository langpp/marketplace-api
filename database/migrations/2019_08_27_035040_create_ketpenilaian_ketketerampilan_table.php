<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetpenilaianKetketerampilanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('ketpenilaian_ketketerampilan', function (Blueprint $table) {
            $table->Increments('id_ketketerampilan');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nilai_start');
            $table->integer('nilai_end');
            $table->text('keterangan_keterampilan');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_ketketerampilan']);
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
        Schema::drop('ketpenilaian_ketketerampilan', function (Blueprint $table) {
            $table->dropForeign('ketpenilaian_ketketerampilan_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('ketpenilaian_ketketerampilan');
    }
}
