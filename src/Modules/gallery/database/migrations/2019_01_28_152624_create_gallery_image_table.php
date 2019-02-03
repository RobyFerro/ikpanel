<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImageTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('gallery_image', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->string('keywords', 255)->nullable();
			$table->string('path', 255)->nullable();
			$table->string('thumbnail', 255)->nullable();
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
		Schema::dropIfExists('gallery_image');
	}
}
