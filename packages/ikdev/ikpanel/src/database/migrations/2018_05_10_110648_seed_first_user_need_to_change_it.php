<?php

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ikdev\Ikpanel\app\Users;
use Ikdev\Ikpanel\app\Role;

class SeedFirstUserNeedToChangeIt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mod_users = new Users();
        $mod_role = new Role();

        try {
            $mod_role->group_name = 'Administator';
            $mod_role->save();
        } catch (QueryException $e) {
            throw $e;
        } // try

        try {
            $mod_users->name = 'Roberto';
            $mod_users->surname = 'Ferro';
            $mod_users->email = 'roberto.ferro@ikdev.eu';
            $mod_users->role = $mod_role->id;
            $mod_users->password = bcrypt("toor");
            $mod_users->save();
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
