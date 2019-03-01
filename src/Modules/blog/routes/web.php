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
		
		Route::group(['as' => 'blogIkpanelModule'], function() {
			Route::prefix('mod/blog')->group(function() {
				
				// Categories
				Route::get('categories/show', 'BlogCategoryController@show');
				Route::get('categories/filter/{type}', 'BlogCategoryController@getFilteredCategories');
				Route::get('categories/edit/{id}', 'BlogCategoryController@edit');
				Route::get('categories/new', 'BlogCategoryController@new');
				
				Route::delete('categories/delete/{id}', 'BlogCategoryController@delete');
				Route::put('categories/restore/{id}', 'BlogCategoryController@restore');
				Route::post('categories/edit', 'BlogCategoryController@update');
				Route::post('categories/new', 'BlogCategoryController@insert');
				
				// Articles
				Route::get('articles/show', 'BlogPostController@show');
				Route::get('articles/filter/{type}', 'BlogPostController@getFilteredCategories');
				Route::get('articles/edit/{id}', 'BlogPostController@edit');
				Route::get('articles/new', 'BlogPostController@new');
				
				Route::delete('articles/delete/{id}', 'BlogPostController@delete');
				Route::put('articles/restore/{id}', 'BlogPostController@restore');
				Route::post('articles/edit', 'BlogPostController@update');
				Route::post('articles/new', 'BlogPostController@insert');
				
			});
		});
		
	});
	
});
