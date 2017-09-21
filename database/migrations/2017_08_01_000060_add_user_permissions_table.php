<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('ssystem')->create('sys_user_permissions', function (blueprint $table) {
      	$table->increments('id_usr_per');
      	$table->integer('user_id')->unsigned();
      	$table->integer('permission_id')->unsigned();
      	$table->integer('privilege_id')->unsigned();

        $table->unique(['user_id','permission_id','privilege_id']);
      	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      	$table->foreign('permission_id')->references('id_module')->on('syss_modules')->onDelete('cascade');
      	$table->foreign('privilege_id')->references('id_privilege')->on('syss_privileges')->onDelete('cascade');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sys_user_permissions');
    }
}
