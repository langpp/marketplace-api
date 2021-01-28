<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGolonganKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_golongan_kelas', function (Blueprint $table) {
            $table->Increments('id_golongan');
            $table->string('golongan', 30);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_golongan']);
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
        Schema::dropIfExists('t_golongan_kelas');
    }
}
