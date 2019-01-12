<?php

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'blogIkpanelModule'], function() {
			Route::prefix('mod/blog')->group(function() {
				Route::get('categories/show', 'BlogCategoryController@show');
				Route::get('categories/filter/{type}', 'BlogCategoryController@getFilteredItems');
				Route::get('articles/show', 'BlogCategoryController@show');
			});
		});
		
	});
	
});