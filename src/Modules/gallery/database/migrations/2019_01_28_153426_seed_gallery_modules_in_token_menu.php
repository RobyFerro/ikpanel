<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use ikdev\ikpanel\app\Menu;
use ikdev\ikpanel\app\RouteGroup;
use ikdev\ikpanel\app\Token;
use ikdev\ikpanel\app\TokenGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;

class SeedGalleryModulesInTokenMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        
        try {
            TokenGroup::insert([
                [
                    "id" => "PHOTO_GALLERY",
                    "group_name" => "Galleria fotografica"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Token::insert([
                [
                    "id" => "SHOW_GALLERY",
                    "name" => "Gestione galleria fotografica",
                    "id_group" => "PHOTO_GALLERY",
                    "id_type" => "VIEW"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            RouteGroup::insert([
                [
                    "name" => "galleryIkpanelModule",
                    "description" => "Modulo galleria",
                    "id_token" => "SHOW_GALLERY"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Menu::insert([
                [
                    "id" => "FOLDER_GALLERY_MODULE",
                    "id_token" => "SHOW_GALLERY",
                    "name" => "Galleria fotografica",
                    "icon" => "fas fa-camera-retro"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Menu::insert([
                [
                    "id" => "ITEM_SHOW_GALLERY_CATEGORIES",
                    "id_token" => "SHOW_GALLERY",
                    "name" => "Categorie",
                    "route" => "/mod/gallery/categories/show",
                    "icon" => "fas fa-book",
                    "relation" => "FOLDER_GALLERY_MODULE"
                ],
                [
                    "id" => "ITEM_SHOW_GALLERY_ARTICLES",
                    "id_token" => "SHOW_GALLERY",
                    "name" => "Immagini",
                    "route" => "/mod/gallery/images/show",
                    "icon" => "fas fa-image",
                    "relation" => "FOLDER_GALLERY_MODULE"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        
        DB::commit();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        DB::beginTransaction();
        
        try {
            Menu::whereIn('id', [
                'FOLDER_GALLERY_MODULE',
                'ITEM_SHOW_GALLERY_ARTICLES',
                'ITEM_SHOW_GALLERY_CATEGORIES'
            ])->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            RouteGroup::where('name', '=', 'galleryIkpanelModule')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Token::where('id', '=', 'SHOW_GALLERY')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            TokenGroup::where('id', '=', 'PHOTO_GALLERY')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        DB::commit();
        
    }
}
