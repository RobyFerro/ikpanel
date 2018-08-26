<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_token',64)->nullable();
            $table->string('name',50);
            $table->string('route', 255)->nullable();
            $table->string('icon', 50)->nullable();
            $table->integer('relation',64)->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::table('menu', function (Blueprint $table){
            $table->foreign('relation')->references('id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
