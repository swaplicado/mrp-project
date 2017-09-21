<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user_companies', function (blueprint $table) {
          $table->increments('id_usr_comp');
          $table->integer('user_id')->unsigned();
          $table->integer('company_id')->unsigned();
          $table->integer('created_by_id')->unsigned();
          $table->timestamps();

          $table->unique(['user_id','company_id']);
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('company_id')->references('id_company')->on('sys_companies')->onDelete('cascade');
          $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sys_user_companies');
    }
}
