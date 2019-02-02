<?php

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'galleryIkpanelModule'], function() {
			Route::prefix('mod/gallery')->group(function() {
				Route::get('categories/show', 'GalleryCategoryController@index');
				Route::get('categories/new', 'GalleryCategoryController@new');
				Route::get('categories/edit/{id}', 'GalleryCategoryController@edit');
				Route::get('categories/filter/{type}', 'GalleryCategoryController@getFilteredCategories');
				
				Route::post('categories/new', 'GalleryCategoryController@insert');
				Route::post('categories/edit', 'GalleryCategoryController@update');
				Route::delete('categories/delete/{id}', 'GalleryCategoryController@delete');
				Route::put('categories/restore/{id}', 'GalleryCategoryController@restore');
				
			});
		});
	});
});
