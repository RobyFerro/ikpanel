<?php

Route::prefix(env('IKPANEL_URL'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'blogIkpanelModule'], function() {
			Route::prefix('mod/blog')->group(function() {
				Route::get('categories/show', 'BlogCategoryController@show');
				Route::get('articles/show', 'BlogCategoryController@show');
			});
		});
		
	});
	
});