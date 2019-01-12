<?php

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'blogIkpanelModule'], function() {
			Route::prefix('mod/blog')->group(function() {
				
				// Categories
				Route::get('categories/show', 'BlogCategoryController@show');
				Route::get('categories/filter/{type}', 'BlogCategoryController@getFilteredCategories');
				Route::get('categories/edit/{id}', 'BlogCategoryController@edit');
				Route::delete('categories/delete/{id}', 'BlogCategoryController@delete');
				Route::put('categories/restore/{id}', 'BlogCategoryController@restore');
				Route::post('categories/edit', 'BlogCategoryController@update');
				
				// Articles
				Route::get('articles/show', 'BlogCategoryController@show');
			});
		});
		
	});
	
});