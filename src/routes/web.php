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

    Route::post('/login', 'LoginController@authenticate');

    Route::post('/logout', "LoginController@logout");

    Route::get('/login', function(){
        return view('ikpanel::login');
    });

    Route::group(['middleware' => 'ikdev\ikpanel\Http\Middleware\AuthMiddleware'], function () {
        Route::get('/users', 'UserController@index');
        Route::get('/users/edit/{id}', 'UserController@edit');
        Route::put('/users/edit', 'UserController@update');
        Route::put('/users/insert', 'UserController@insert');
        Route::delete('/users/delete', 'UserController@remove');

        Route::get('/', function () {
            return view('ikpanel::dashboard');
        });
    });


});

/*Route::group(['middleware' => 'ikdev\ikpanel\Http\Middleware\AuthMiddleware'], function () {

    Route::get('/users', 'UserController@index');
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::put('/users/edit', 'UserController@update');
    Route::put('/users/insert', 'UserController@insert');
    Route::delete('/users/delete', 'UserController@remove');

    Route::get('/dashboard', function () {
        return view('ikpanel::dashboard');
    });
});*/
