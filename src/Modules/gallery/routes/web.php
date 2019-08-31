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
        
        Route::prefix('mod/gallery')->group(function () {
            
            // Images
            Route::middleware('can:gallery-images.view')->group(function () {
                Route::get('images/show', 'GalleryImagesController@index');
                Route::get('images/filter/{type}', 'GalleryImagesController@getFilteredCategories');
            });
            
            Route::middleware('can:gallery-images.create')->group(function () {
                Route::get('images/new', 'GalleryImagesController@new');
                Route::post('image/new', 'GalleryImagesController@insert');
            });
            
            Route::middleware('can:gallery-images.update')->group(function () {
                Route::get('images/edit/{id}', 'GalleryImagesController@edit');
                Route::post('image/edit', 'GalleryImagesController@update');
            });
            
            Route::middleware('can:gallery-images.delete')->group(function () {
                Route::delete('images/delete/{id}', 'GalleryImagesController@delete');
            });
            
            Route::middleware('can:gallery-images.restore')->group(function () {
                Route::put('images/restore/{id}', 'GalleryImagesController@restore');
            });
            
            // Categories
            Route::middleware('can:gallery-categories.view')->group(function () {
                Route::get('categories/show', 'GalleryCategoryController@index');
                Route::get('categories/filter/{type}', 'GalleryCategoryController@getFilteredCategories');
            });
            
            Route::middleware('can:gallery-categories.create')->group(function () {
                Route::get('categories/new', 'GalleryCategoryController@new');
                Route::post('categories/new', 'GalleryCategoryController@insert');
            });
            
            Route::middleware('can:gallery-categories.update')->group(function () {
                Route::get('categories/edit/{id}', 'GalleryCategoryController@edit');
                Route::post('categories/edit', 'GalleryCategoryController@update');
            });
            
            Route::middleware('can:gallery-categories.delete')->group(function () {
                Route::delete('categories/delete/{id}', 'GalleryCategoryController@delete');
            });
            
            Route::middleware('can:gallery-categories.restore')->group(function () {
                Route::put('categories/restore/{id}', 'GalleryCategoryController@restore');
            });
            
        });
    });
});
