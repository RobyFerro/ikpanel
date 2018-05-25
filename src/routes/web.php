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

Route::prefix(env('IKPANEL_URL'))->group(function(){

	//region AUTENTICAZIONE
    Route::post('/login', 'LoginController@authenticate');
    Route::post('/logout', "LoginController@logout");
    Route::get('/login', function(){
        return view('ikpanel::login');
    });
    //endregion

    Route::group(['middleware' => 'ikdev\ikpanel\Http\Middleware\AuthMiddleware'], function () {

	    Route::get('/', function () {
		    return view('ikpanel::dashboard');
	    });

	    Route::prefix('users')->group(function(){

		    Route::group(['as'=>'showUsers'],function(){
			    Route::get('/', 'UserController@index');
		    });

		    Route::group(['as'=>'addUser'],function(){
			    Route::put('/users/insert', 'UserController@insert');
		    });

		    Route::group(['as'=>'editUser'],function(){
			    Route::get('/users/edit/{id}', 'UserController@edit');
			    Route::put('/users/edit', 'UserController@update');
		    });

		    Route::group(['as'=>'deleteUser'],function(){
		    	Route::delete('/users/delete', 'UserController@remove');
		    });
        });

	    Route::prefix('roles')->group(function(){
		    Route::group(['as'=>'showRoles'],function(){
				Route::get('/','RoleController@show');
		    });

		    Route::group(['as'=>'addRole'],function(){
			    Route::get('/new','RoleController@add');
			    Route::post('/insert','RoleController@insert');
		    });

		    Route::group(['as'=>'editRole'],function(){
			    Route::get('/edit/{id}','RoleController@edit');
			    Route::put('/update','RoleController@update');
		    });

		    Route::group(['as'=>'deleteRole'],function(){
			    Route::delete('/delete/{id}','RoleController@delete');
		    });
	    });
    });
});