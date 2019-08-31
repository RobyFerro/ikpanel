<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use Illuminate\Support\Facades\Config;

Route::prefix(Config::get('ikpanel-config.admin_panel_url'))->group(function () {
    
    Route::group(['middleware' => 'ikpanel'], function () {
        
        Route::prefix('mod/blog')->group(function () {
            
            // Categories
            Route::middleware('can:blog-categories.view')->group(function () {
                Route::get('categories/show', 'BlogCategoryController@show');
                Route::get('categories/filter/{type}', 'BlogCategoryController@getFilteredCategories');
            });
            
            Route::middleware('can:blog-categories.create')->group(function () {
                Route::get('categories/new', 'BlogCategoryController@new');
                Route::post('categories/new', 'BlogCategoryController@insert');
            });
            
            Route::middleware('can:blog-categories.update')->group(function () {
                Route::get('categories/edit/{id}', 'BlogCategoryController@edit');
                Route::post('categories/edit', 'BlogCategoryController@update');
            });
            
            Route::middleware('can:blog-categories.delete')->group(function () {
                Route::delete('categories/delete/{id}', 'BlogCategoryController@delete');
            });
            
            Route::middleware('can:blog-categories.restore')->group(function () {
                Route::put('categories/restore/{id}', 'BlogCategoryController@restore');
            });
            
            // Articles
            
            Route::middleware('can:blog-articles.view')->group(function () {
                Route::get('articles/show', 'BlogPostController@show');
                Route::get('articles/filter/{type}', 'BlogPostController@getFilteredCategories');
            });
            
            Route::middleware('can:blog-articles.create')->group(function () {
                Route::get('articles/new', 'BlogPostController@new');
                Route::post('articles/new', 'BlogPostController@insert');
            });
            
            Route::middleware('can:blog-articles.update')->group(function () {
                Route::get('articles/edit/{id}', 'BlogPostController@edit');
                Route::post('articles/edit', 'BlogPostController@update');
            });
            
            Route::middleware('can:blog-articles.delete')->group(function () {
                Route::delete('articles/delete/{id}', 'BlogPostController@delete');
            });
            
            Route::middleware('can:blog-articles.restore')->group(function () {
                Route::put('articles/restore/{id}', 'BlogPostController@restore');
            });
            
        });
        
    });
    
});
