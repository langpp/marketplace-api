<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetpenilaianBobotnilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::create('ketpenilaian_bobotnilai', function (Blueprint $table) {
            $table->Increments('id_bobotnilai');
            $table->integer('id_thn_ajaran')->unsigned();
            $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('NUH');
            $table->integer('PTS');
            $table->integer('PAS');
            $table->integer('pembagi');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_bobotnilai', 'id_thn_ajaran']);
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
        Schema::drop('ketpenilaian_bobotnilai', function (Blueprint $table) {
            $table->dropForeign('ketpenilaian_bobotnilai_id_thn_ajaran_foreign');
        });
        
        Schema::dropIfExists('ketpenilaian_bobotnilai');
    }
}
