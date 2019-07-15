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
			$table->enum('type', ['front', 'back']);
			$table->integer('guilty_id')->nullable();
			$table->integer('assign_to')->nullable();
			$table->timestamp('fixed_at')->nullable();
			$table->integer('fixed_by')->nullable();
			$table->foreign('fixed_by')->references('id')->on('users');
			$table->timestamp('first_seen')->nullable();
			$table->timestamp('last_seen')->nullable();
			$table->ipAddress('ip')->nullable();
			$table->text('user_agent')->nullable();
			$table->json('exception');
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
		Schema::dropIfExists('error_exception_log');
	}
}
