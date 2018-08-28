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
			'id'       => 'FOLDER_SETTINGS',
			'id_token' => 'SHOW_SETTINGS',
			'name'     => 'Impostazioni',
			'route'    => null,
			'icon'     => 'fas fa-cogs',
			'relation' => null
		]);
		
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
				'id'       => 'ITEM_FILE_MANAGER',
				'id_token' => 'FILE_MANAGER',
				'name'     => 'File manager',
				'route'    => '/file-manager',
				'icon'     => 'far fa-file',
				'relation' => 'FOLDER_SETTINGS'
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
