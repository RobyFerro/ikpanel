<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentErrorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_error', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exception_id');
            $table->foreign('exception_id')->references('id')->on('error_exception_log');
            $table->integer('comment_id');
            $table->foreign('comment_id')->references('id')->on('exception_comment');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_error');
    }
}
