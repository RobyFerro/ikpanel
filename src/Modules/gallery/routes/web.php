<?php

Route::prefix(\Illuminate\Support\Facades\Config::get('ikpanel-config.admin_panel_url'))->group(function() {
	
	Route::group(['middleware' => 'ikpanel'], function() {
		
		Route::group(['as' => 'galleryIkpanelModule'], function() {
			Route::prefix('mod/gallery')->group(function() {
				
				Route::get('images/show', 'GalleryImagesController@index');
				Route::get('images/new', 'GalleryImagesController@new');
				Route::get('images/edit/{id}', 'GalleryImagesController@edit');
				Route::get('images/filter/{type}', 'GalleryImagesController@getFilteredCategories');
				
				Route::get('categories/show', 'GalleryCategoryController@index');
				Route::get('categories/new', 'GalleryCategoryController@new');
				Route::get('categories/edit/{id}', 'GalleryCategoryController@edit');
				Route::get('categories/filter/{type}', 'GalleryCategoryController@getFilteredCategories');
				
				Route::post('image/new', 'GalleryImagesController@insert');
				Route::post('image/edit', 'GalleryImagesController@update');
				Route::post('categories/new', 'GalleryCategoryController@insert');
				Route::post('categories/edit', 'GalleryCategoryController@update');
				
				Route::delete('images/delete/{id}', 'GalleryImagesController@delete');
				Route::delete('categories/delete/{id}', 'GalleryCategoryController@delete');
				
				Route::put('images/restore/{id}', 'GalleryImagesController@restore');
				Route::put('categories/restore/{id}', 'GalleryCategoryController@restore');
				
			});
		});
	});
});
