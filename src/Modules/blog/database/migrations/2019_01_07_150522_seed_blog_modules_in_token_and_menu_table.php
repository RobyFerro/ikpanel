<?php

use ikdev\ikpanel\app\Menu;
use ikdev\ikpanel\app\RouteGroup;
use ikdev\ikpanel\app\Token;
use ikdev\ikpanel\app\TokenGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SeedBlogModulesInTokenAndMenuTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::beginTransaction();
		
		try {
			TokenGroup::insert([
				[
					"id"         => "BLOG",
					"group_name" => "Blog"
				]
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Token::insert([
				[
					"id"       => "SHOW_BLOG",
					"name"     => "Gestione blog",
					"id_group" => "BLOG",
					"id_type"  => "VIEW"
				]
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			RouteGroup::insert([
				[
					"name"        => "blogIkpanelModule",
					"description" => "Modulo blog",
					"id_token"    => "SHOW_BLOG"
				]
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Menu::insert([
				[
					"id"       => "FOLDER_BLOG_MODULE",
					"id_token" => "SHOW_BLOG",
					"name"     => "Blog",
					"icon"     => "fas fa-thumbtack"
				]
			]);
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Menu::insert([
				[
					"id"       => "ITEM_SHOW_BLOG_CATEGORIES",
					"id_token" => "SHOW_BLOG",
					"name"     => "Categorie",
					"route"    => "/mod/blog/categories/show",
					"icon"     => "fas fa-comments-alt",
					"relation" => "FOLDER_BLOG_MODULE"
				],
				[
					"id"       => "ITEM_SHOW_BLOG_ARTICLES",
					"id_token" => "SHOW_BLOG",
					"name"     => "Articoli",
					"route"    => "/mod/blog/articles/show",
					"icon"     => "fas fa-font",
					"relation" => "FOLDER_BLOG_MODULE"
				]
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
			Menu::whereIn('id', [
				'FOLDER_BLOG_MODULE',
				'ITEM_SHOW_BLOG_CATEGORIES',
				'ITEM_SHOW_BLOG_ARTICLES'
			])->delete();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			RouteGroup::where('name', '=', 'blogIkpanelModule')
				->delete();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			Token::where('id', '=', 'SHOW_BLOG')
				->delete();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		try {
			TokenGroup::where('id', '=', 'BLOG')
				->delete();
		} catch (QueryException $e) {
			DB::rollBack();
			throw $e;
		} // try
		
		DB::commit();
		
	}
}
