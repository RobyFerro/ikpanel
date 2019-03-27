<?php

use ikdev\ikpanel\app\Token;
use ikdev\ikpanel\app\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CreateTokenAndMenuItemHandleExceptions extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::beginTransaction();
		
		try {
			Token::insert([
				"id"       => "SHOW_EXCEPTIONS",
				"name"     => "Gestione errori di sistema",
				"id_group" => "GENERAL_SETTINGS",
				"id_type"  => "VIEW"
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Menu::insert([
				"id"        => "ITEM_HANDLE_EXCEPTIONS",
				"id_token"  => "SHOW_EXCEPTIONS",
				"name"      => "Gestione errori di sistema",
				"route"     => "/exceptions/show",
				"icon"      => "far fa-bug",
				"relations" => "FOLDER_SETTINGS"
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		DB::commit();
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::beginTransaction();
		
		try {
			Menu::where('id', 'ITEM_HANDLE_EXCEPTIONS')->delete();
			Token::where('id', 'SHOW_EXCEPTIONS')->delete();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		DB::commit();
	}
}
