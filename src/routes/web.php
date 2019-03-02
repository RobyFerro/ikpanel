<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	//region Authentication
	Route::post('/login', 'LoginController@authenticate');
	Route::post('/logout', "LoginController@logout");
	Route::get('/login', function() {
		return view('ikpanel::login');
	});
	//endregion
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::get('/', 'ikpanelController@home');
		Route::get('/navigation', 'ikpanelController@getUserMenu');
		Route::get('/search', 'ikpanelController@search');
		Route::get('/profile', 'ikpanelController@profile');
		Route::get('/notifications', 'NotificationController@showNotifications');
		Route::post('/profile/update', 'ikpanelController@profileUpdate');
		
		Route::prefix('users')->group(function() {
			
			Route::middleware('can:users.view')->group(function() {
				Route::get('/', 'UserController@show');
				Route::get('/filter/{filter}', 'UserController@filter');
			});
			
			Route::middleware('can:users.create')->group(function() {
				Route::get('/new', 'UserController@add');
				Route::post('/insert', 'UserController@insert');
			});
			
			Route::middleware('can:users.update')->group(function() {
				Route::get('/edit/{id}', 'UserController@edit');
				Route::post('/update', 'UserController@update');
			});
			
			Route::middleware('can:users.delete')->group(function() {
				Route::delete('/delete/{id}', 'UserController@delete');
			});
			
			Route::middleware('can:users.restore')->group(function() {
				Route::put('/restore/{id}', 'UserController@restore');
			});
		});
		
		Route::prefix('roles')->group(function() {
			
			Route::middleware('can:roles.view')->group(function() {
				Route::get('/', 'RoleController@show');
				Route::get('/filter/{filter}', 'RoleController@filter');
			});
			
			Route::middleware('can:roles.create')->group(function() {
				Route::get('/new', 'RoleController@add');
				Route::post('/insert', 'RoleController@insert');
			});
			
			Route::middleware('can:roles.update')->group(function() {
				Route::get('/edit/{id}', 'RoleController@edit');
				Route::put('/update', 'RoleController@update');
			});
			
			Route::middleware('can:roles.delete')->group(function() {
				Route::delete('/delete/{id}', 'RoleController@delete');
			});
			
			Route::middleware('can:roles.restore')->group(function() {
				Route::put('/restore/{id}', 'RoleController@restore');
			});
		});
		
		Route::prefix('logs')->group(function() {
			Route::group(['as' => 'showLogs'], function() {
				Route::get('/', 'LogsController@show');
			});
		});
		
		Route::prefix('file-manager')->group(function() {
			
			Route::group(['as' => 'filemanager'], function() {
				Route::get('/', 'ikpanelController@showFileManager');
			});
			
		});
		
	});
});
