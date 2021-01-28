<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('t_admin', function (Blueprint $table) {
    		$table->Increments('id');
    		$table->string('username', 40)->unique();
    		$table->string('password', 100);
    		$table->timestamps();
    		$table->softDeletes();
    		$table->index(['id', 'username']);
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('t_admin');
    }
}
