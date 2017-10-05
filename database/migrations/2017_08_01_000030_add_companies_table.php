<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::connection('ssystem')->create('sys_companies', function (blueprint $table) {
      	$table->increments('id_company');
      	$table->char('name', 100);
      	$table->char('database_name', 100);
      	$table->char('host', 50);
      	$table->char('port', 10);
      	$table->char('database_user', 50);
      	$table->char('password', 150);
      	$table->char('default_schema', 150);
      	$table->boolean('is_deleted');
      	$table->integer('created_by_id')->unsigned();
      	$table->integer('updated_by_id')->unsigned();
      	$table->timestamps();

      	$table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
      	$table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
      });

      DB::table('sys_companies')->insert([
      	['id_company' => '1','name' => 'Cartro','database_name' => 'siie_cartro','host' => 'localhost','port' => '3306','database_user' => 'root','password' => 'msroot','default_schema' => '', 'is_deleted' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
      	['id_company' => '2','name' => 'AETH','database_name' => 'siie_aeth','host' => 'localhost','port' => '3306','database_user' => 'root','password' => 'msroot','default_schema' => '', 'is_deleted' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
      ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('sys_companies');
    }
}
