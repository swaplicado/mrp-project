<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::connection('ssystem')->create('syss_company_modules', function (blueprint $table) {
      	$table->increments('id_com_mod');
      	$table->boolean('is_deleted');
      	$table->integer('company_id')->unsigned();
      	$table->integer('module_id')->unsigned();
      	$table->timestamps();

        $table->unique(['company_id', 'module_id']);
      	$table->foreign('company_id')->references('id_company')->on('sys_companies')->onDelete('cascade');
      	$table->foreign('module_id')->references('id_module')->on('syss_modules')->onDelete('cascade');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('syss_company_modules');
    }
}
