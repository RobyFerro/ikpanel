<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post_category', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_category');
			$table->foreign('id_category')->references('id')->on('blog_categories');
			$table->integer('id_post');
			$table->foreign('id_post')->references('id')->on('post');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('post_category');
	}
}
