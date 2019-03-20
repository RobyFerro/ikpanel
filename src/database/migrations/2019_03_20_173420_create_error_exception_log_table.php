<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorExceptionLogTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('error_exception_log', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('guilty_id')->nullable();
			$table->integer('assign_to');
			$table->timestamp('fixed_at');
			$table->integer('fixed_by');
			$table->json('exception');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('error_exception_log');
	}
}
