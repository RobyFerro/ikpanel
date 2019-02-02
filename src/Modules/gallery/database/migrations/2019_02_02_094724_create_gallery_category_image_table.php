<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryCategoryImageTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('gallery_category_image', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_category');
			$table->foreign('id_category')->references('id')->on('gallery_category');
			$table->integer('id_image');
			$table->foreign('id_image')->references('id')->on('gallery_image');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('gallery_category_image');
	}
}
