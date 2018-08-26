<?php

use ecit\admin_panel\app\Token;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
        		'id'=>'SHOW_USERS',
		        'name'=>'Gestione utenti',
		        'id_group'=>'USERS',
		        'id_type'=>'VIEW',
		        'relation'=>null
	        ],
	        [
		        'id'=>'SHOW_ROLES',
		        'name'=>'Gestione ruoli',
		        'id_group'=>'USERS',
		        'id_type'=>'VIEW',
		        'relation'=>null
	        ],
	        [
		        'id'=>'SHOW_LOGS',
		        'name'=>'Logs',
		        'id_group'=>'USERS',
		        'id_type'=>'VIEW',
		        'relation'=>null
	        ],
            [
                'id'=>'SHOW_SETTINGS',
                'name'=>'Impostazioni',
                'id_group'=>'GENERAL_SETTINGS',
                'id_type'=>'VIEW',
                'relation'=>null
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
