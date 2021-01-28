<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahunajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tahun_ajaran', function (Blueprint $table) {
            $table->Increments('id_thn_ajaran');
            $table->string('tahun_ajaran', 40);
            $table->integer('semester');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->index('id_thn_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_tahun_ajaran');
    }
}
