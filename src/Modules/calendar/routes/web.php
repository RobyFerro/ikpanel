<?php

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'calendarIkpanelModule'], function() {
			Route::prefix('mod/calendar')->group(function() {
			
			});
		});
	});
});
