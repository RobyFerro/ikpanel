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
use Illuminate\Support\Facades\DB;

class SeedCalendarModulesInTokenAndMenuTable extends Migration
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
                    "id" => "CALENDAR",
                    "group_name" => "Calendario eventi"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Token::insert([
                [
                    "id" => "SHOW_CALENDAR",
                    "name" => "Gestione calendario",
                    "id_group" => "CALENDAR",
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
                    "name" => "calendarIkpanelModule",
                    "description" => "Modulo calendario",
                    "id_token" => "SHOW_CALENDAR"
                ]
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Menu::insert([
                [
                    "id" => "ITEM_SHOW_CALENDAR",
                    "id_token" => "SHOW_CALENDAR",
                    "name" => "Calendario",
                    "route" => "/mod/calendar",
                    "icon" => "far fa-calendar-alt",
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
                'ITEM_SHOW_CALENDAR',
            ])->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            RouteGroup::where('name', '=', 'calendarIkpanelModule')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            Token::where('id', '=', 'SHOW_CALENDAR')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        try {
            TokenGroup::where('id', '=', 'CALENDAR')
                ->delete();
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        } // try
        
        DB::commit();
        
    }
}
