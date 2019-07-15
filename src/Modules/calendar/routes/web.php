<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'calendarIkpanelModule'], function() {
			Route::prefix('mod/calendar')->group(function() {
				Route::get('/', 'CalendarController@index');
				Route::get('/events', 'CalendarController@getEvents');
				Route::post('/new', 'CalendarController@store');
				Route::post('/edit/{id}', 'CalendarController@update');
			});
		});
	});
});
