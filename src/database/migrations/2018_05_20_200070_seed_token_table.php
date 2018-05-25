<?php

use ikdev\ikpanel\app\Token;
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
        	//region USERS
        	[
        		'id'=>'SHOW_USERS',
		        'name'=>'showUsers',
		        'description'=>'Gestione utenti',
		        'id_group'=>'USERS',
		        'id_type'=>'VIEW',
		        'relation'=>null
	        ],
	        //endregion
	
	        //region ROLES
	        [
		        'id'=>'SHOW_ROLES',
		        'name'=>'showRoles',
		        'description'=>'Gestione ruoli',
		        'id_group'=>'USERS',
		        'id_type'=>'VIEW',
		        'relation'=>null
	        ]
	        //endregion
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
