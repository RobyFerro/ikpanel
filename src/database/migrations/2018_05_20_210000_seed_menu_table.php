<?php

use ecit\admin_panel\app\Menu;
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
				'id'       => 'ITEM_SHOW_USERS',
				'id_token' => 'SHOW_USERS',
				'name'     => 'Utenti',
				'route'    => '/users',
				'icon'     => 'fas fa-users',
				'relation' => 'FOLDER_SETTINGS'
			],
			[
				'id'       => 'ITEM_SHOW_ROLES',
				'id_token' => 'SHOW_ROLES',
				'name'     => 'Ruoli',
				'route'    => '/roles',
				'icon'     => 'fas fa-user-shield',
				'relation' => 'FOLDER_SETTINGS'
			],
			[
				'id'       => 'ITEM_SHOW_LOGS',
				'id_token' => 'SHOW_LOGS',
				'name'     => 'Logs',
				'route'    => '/logs',
				'icon'     => 'fas fa-user-secret',
				'relation' => 'FOLDER_SETTINGS'
			],
            [
                'id'       => 'FOLDER_SETTINGS',
                'id_token' => 'SHOW_SETTINGS',
                'name'     => 'Impostazioni',
                'route'    => null,
                'icon'     => 'fas fa-cogs',
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
