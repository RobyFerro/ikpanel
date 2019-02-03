<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostTableAddThumbnailColumn extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('post', function(Blueprint $table) {
			$table->string('thumbnail', 255)->nullable();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('post', function(Blueprint $table) {
			$table->dropColumn('thumbnail');
		});
	}
}
