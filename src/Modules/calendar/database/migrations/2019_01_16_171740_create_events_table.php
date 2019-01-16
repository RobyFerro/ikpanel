<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->dateTime('start')->nullable();
			$table->dateTime('end')->nullable();
			$table->boolean('all_day')->default(false);
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->string('location', 255)->nullable();
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
		Schema::dropIfExists('events');
	}
}
