<?php

use ikdev\ikpanel\app\Menu;
use Illuminate\Database\Migrations\Migration;

class SeedMenuTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Menu::insert([
			[
				'id'       => 'SHOW_USERS',
				'id_token' => 'SHOW_USERS',
				'name'     => 'Utenti',
				'route'    => '/users',
				'icon'     => 'fas fa-users',
				'relation' => null
			],
			[
				'id'       => 'SHOW_ROLES',
				'id_token' => 'SHOW_ROLES',
				'name'     => 'Ruoli',
				'route'    => '/roles',
				'icon'     => 'fas fa-user-shield',
				'relation' => null
			]
		]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
	}
}
