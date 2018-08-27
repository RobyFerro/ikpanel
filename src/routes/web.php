<?php

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

Route::prefix(env('IKPANEL_URL'))->group(function() {
	
	//region AUTENTICAZIONE
	Route::post('/login', 'LoginController@authenticate');
	Route::post('/logout', "LoginController@logout");
	Route::get('/login', function() {
		return view('ikpanel::login');
	});
	//endregion
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::get('/', 'ikpanelController@home');
		Route::get('/search', 'ikpanelController@search');
		Route::get('/profile', 'ikpanelController@profile');
		Route::post('/profile/update', 'ikpanelController@profileUpdate');
		
		Route::prefix('users')->group(function() {
			
			Route::group(['as' => 'showUsers'], function() {
				Route::get('/', 'UserController@show');
				Route::get('/filter/{filter}', 'UserController@filter');
			});
			
			Route::group(['as' => 'addUser'], function() {
				Route::get('/new', 'UserController@add');
				Route::post('/insert', 'UserController@insert');
			});
			
			Route::group(['as' => 'editUser'], function() {
				Route::get('/edit/{id}', 'UserController@edit');
				Route::post('/update', 'UserController@update');
			});
			
			Route::group(['as' => 'deleteUser'], function() {
				Route::delete('/delete/{id}', 'UserController@delete');
				Route::put('/restore/{id}', 'UserController@restore');
			});
		});
		
		Route::prefix('roles')->group(function() {
			Route::group(['as' => 'showRoles'], function() {
				Route::get('/', 'RoleController@show');
				Route::get('/filter/{filter}', 'RoleController@filter');
			});
			
			Route::group(['as' => 'addRole'], function() {
				Route::get('/new', 'RoleController@add');
				Route::post('/insert', 'RoleController@insert');
			});
			
			Route::group(['as' => 'editRole'], function() {
				Route::get('/edit/{id}', 'RoleController@edit');
				Route::put('/update', 'RoleController@update');
			});
			
			Route::group(['as' => 'deleteRole'], function() {
				Route::delete('/delete/{id}', 'RoleController@delete');
				Route::put('/restore/{id}', 'RoleController@restore');
			});
		});
		
		Route::prefix('logs')->group(function() {
			Route::group(['as' => 'showLogs'], function() {
				Route::get('/', 'LogsController@show');
			});
		});
		
	});
});