<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use ikdev\ikpanel\app\TokenGroup;
use Illuminate\Database\Migrations\Migration;

class SeedTokenGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        TokenGroup::insert([
            [
                'id' => 'USERS',
                'group_name' => 'Utenti'
            ],
            [
                'id' => 'GENERAL_SETTINGS',
                'group_name' => 'Generali'
            ]
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
