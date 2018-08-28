<?php

use ikdev\ikpanel\app\RouteGroup;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedRouteGroupeTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		RouteGroup::insert([
			[
				'name'        => 'showUsers',
				'description' => 'Mostra tutti gli utenti',
				'id_token'    => 'SHOW_USERS'
			],
			[
				'name'        => 'addUser',
				'description' => 'Crea utente',
				'id_token'    => 'SHOW_USERS'
			],
			[
				'name'        => 'editUser',
				'description' => 'Modifica utente',
				'id_token'    => 'SHOW_USERS'
			],
			[
				'name'        => 'deleteUser',
				'description' => 'Elimina utente',
				'id_token'    => 'SHOW_USERS'
			],
			[
				'name'        => 'showRoles',
				'description' => 'Mostra tutti i ruoli',
				'id_token'    => 'SHOW_ROLES'
			],
			[
				'name'        => 'addRole',
				'description' => 'Crea ruoli',
				'id_token'    => 'SHOW_ROLES'
			],
			[
				'name'        => 'editRole',
				'description' => 'Modifica ruoli',
				'id_token'    => 'SHOW_ROLES'
			],
			[
				'name'        => 'deleteRole',
				'description' => 'Elimina ruoli',
				'id_token'    => 'SHOW_ROLES'
			],
			[
				'name'        => 'filemanager',
				'description' => 'Accedi al file manager',
				'id_token'    => 'FILE_MANAGER'
			]
		]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
