<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryCategoryTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('gallery_category', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('keywords', 255)->nullable();
			$table->text('description')->nullable();
			$table->string('main_pic', 255)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('gallery_category');
	}
}
