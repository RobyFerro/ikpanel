<?php

use ikdev\ikpanel\app\Role;
use ikdev\ikpanel\app\Users;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;

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
            $mod_role->group_name = 'Amministratore';
            $mod_role->save();
        } catch (QueryException $e) {
            throw $e;
        } // try

        try {
            $mod_users->name = 'Super';
            $mod_users->surname = 'User';
            $mod_users->email = 'test@ecit.it';
            $mod_users->role = $mod_role->id;
            $mod_users->password = bcrypt("0");
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
    }
}
