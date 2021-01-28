<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetpenilaianKetbelajarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('ketpenilaian_ketbelajar', function (Blueprint $table) {
            $table->Increments('id_ketbelajar');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->text('pengetahuan');
            $table->text('keterampilan');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_ketbelajar', 'id_thn_ajaran']);
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
        Schema::drop('ketpenilaian_ketbelajar', function (Blueprint $table) {
            $table->dropForeign('ketpenilaian_ketbelajar_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('ketpenilaian_ketbelajar');
    }
}
