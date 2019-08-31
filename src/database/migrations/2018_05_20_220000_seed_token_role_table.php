<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use ikdev\ikpanel\app\Role;
use Illuminate\Database\Migrations\Migration;

class SeedTokenRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::find(1)->token()->attach([
            'SHOW_USERS', 'SHOW_ROLES', 'SHOW_LOGS', 'SHOW_SETTINGS', 'FILE_MANAGER'
        ]);
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
