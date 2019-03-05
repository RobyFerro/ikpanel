<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTables extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('widgets_category', function(Blueprint $table) {
			$table->string('id');
			$table->json('option');
		});
		
		Schema::create('widgets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('path');
			$table->string('id_category');
			
		});
		
		Schema::create('widgets_role', function(Blueprint $table) {
			$table->integer('id_role');
			$table->foreign('id_role')->references('id')->on('role');
			$table->integer('id_widget');
			$table->foreign('id_widget')->references('id')->on('widgets');
			$table->integer('span');
			$table->integer('order');
			$table->integer('row');
		});
		
		
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		
		Schema::table('widgets_role', function(Blueprint $table) {
			$table->dropForeign(['id_role']);
			$table->dropForeign(['id_widget']);
		});
		
		Schema::dropIfExists('widgets');
		Schema::dropIfExists('widgets_role');
		Schema::dropIfExists('widgets_category');
	}
}
