<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('t_guru', function (Blueprint $table) {
            $table->Increments('id_guru');
            $table->string('nip_guru', 20)->unique();
            $table->string('nama_guru', 100);
            $table->year('thn_masuk');
            $table->string('pendidikan', 100);
            $table->string('gender', 100);
            $table->string('jabatan', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 64);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['id_guru', 'nip_guru', 'username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_guru');
    }
}
