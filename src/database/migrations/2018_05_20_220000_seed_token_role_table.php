<?php

use ikdev\ikpanel\app\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
	        'SHOW_USERS','SHOW_ROLES','SHOW_LOGS','SHOW_SETTINGS'
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
