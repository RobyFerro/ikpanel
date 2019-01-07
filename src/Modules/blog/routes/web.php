<?php

Route::prefix(env('IKPANEL_URL'))->group(function() {
	Route::group(['middleware' => 'ikpanel'], function() {
		// Blog modules routes
	});
});