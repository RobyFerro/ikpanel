<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_category');
			$table->foreign('id_category')->references('id')->on('blog_categories');
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->text('content');
			$table->softDeletes();
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('post');
	}
}
