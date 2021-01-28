<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetpenilaianKetpengetahuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('ketpenilaian_ketpengetahuan', function (Blueprint $table) {
           $table->Increments('id_ketpengetahuan');
           $table->integer('id_thn_ajaran')->unsigned();
           $table->foreign('id_thn_ajaran')->references('id_thn_ajaran')->on('t_tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
           $table->integer('nilai_start');
           $table->integer('nilai_end');
           $table->text('keterangan_pengetahuan');
           $table->timestamps();
           $table->softDeletes();
           $table->index(['id_ketpengetahuan']);
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
        Schema::drop('ketpenilaian_ketpengetahuan', function (Blueprint $table) {
            $table->dropForeign('ketpenilaian_ketpengetahuan_id_thn_ajaran_foreign');
        });
        Schema::dropIfExists('ketpenilaian_ketpengetahuan');
    }
}
