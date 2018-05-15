<?php

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ikdev\Ikpanel\app\Menu;

class SeedMenuTable extends Migration
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
            $mod_menu->name = "Utenti";
            $mod_menu->route = "/users";
            $mod_menu->icon = "fas fa-money-bill-alt";
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
