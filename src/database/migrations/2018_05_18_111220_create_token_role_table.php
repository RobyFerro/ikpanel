<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_role', function (Blueprint $table) {
            $table->integer('tokenid');
            $table->integer('roleid');
            $table->timestamps();
            $table->primary(['tokenid', 'roleid'], 'token_role_pkey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_role');
    }
}
