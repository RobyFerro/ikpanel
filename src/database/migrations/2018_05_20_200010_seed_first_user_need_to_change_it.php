<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

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
            $mod_users->email = 'boba.fett@ikpanel.eu';
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
