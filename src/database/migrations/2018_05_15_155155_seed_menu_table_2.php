<?php

use ikdev\ikpanel\app\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedMenuTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mod_menu = new Menu();

        try {
            $mod_menu->name = "Media";
            $mod_menu->route = "/media";
            $mod_menu->icon = "far fa-image";
            $mod_menu->save();
        } catch (QueryException $e) {
            throw $e;
        } // try
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}