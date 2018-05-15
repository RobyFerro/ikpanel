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
            $table->integer('id',true);
            $table->string('name',50);
            $table->string('route', 255);
            $table->string('icon', 50);
            $table->integer('relation')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
