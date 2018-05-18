<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->foreign('role')->references('id')->on('role');
        });

        Schema::table('menu', function (Blueprint $table){
            $table->foreign('id_token')->references('id')->on('token');
        });

        Schema::table('token', function (Blueprint $table){
            $table->foreign('id_group')->references('id')->on('token_group');
        });

        Schema::table('token_role', function (Blueprint $table){
            $table->foreign('tokenid')->references('id')->on('token');
            $table->foreign('roleid')->references('id')->on('role');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_role_foreign');
        });

        Schema::table('menu', function(Blueprint $table) {
            $table->dropForeign('menu_id_token_foreign');
        });

        Schema::table('token', function(Blueprint $table) {
            $table->dropForeign('token_id_group_foreign');
        });

        Schema::table('token_role', function(Blueprint $table) {
            $table->dropForeign('token_role_tokenid_foreign');
            $table->dropForeign('token_role_roleid_foreign');
        });
    }
}
