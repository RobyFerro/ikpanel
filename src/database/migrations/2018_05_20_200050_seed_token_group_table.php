<?php

use ecit\admin_panel\app\TokenGroup;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
        		'id'=>'USERS',
		        'group_name'=>'Utenti'
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
