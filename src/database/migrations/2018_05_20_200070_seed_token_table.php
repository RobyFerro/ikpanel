<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

use ikdev\ikpanel\app\Token;
use Illuminate\Database\Migrations\Migration;

class SeedTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Token::insert([
            [
                'id' => 'SHOW_USERS',
                'name' => 'Gestione utenti',
                'id_group' => 'USERS',
                'id_type' => 'VIEW',
                'relation' => null
            ],
            [
                'id' => 'SHOW_ROLES',
                'name' => 'Gestione ruoli',
                'id_group' => 'USERS',
                'id_type' => 'VIEW',
                'relation' => null
            ],
            [
                'id' => 'SHOW_LOGS',
                'name' => 'Logs',
                'id_group' => 'USERS',
                'id_type' => 'VIEW',
                'relation' => null
            ],
            [
                'id' => 'SHOW_SETTINGS',
                'name' => 'Impostazioni',
                'id_group' => 'GENERAL_SETTINGS',
                'id_type' => 'VIEW',
                'relation' => null
            ],
            [
                'id' => 'FILE_MANAGER',
                'name' => 'File manager',
                'id_group' => 'GENERAL_SETTINGS',
                'id_type' => 'VIEW',
                'relation' => null
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
        //
    }
}
