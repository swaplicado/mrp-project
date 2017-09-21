<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::connection('ssystem')->create('users', function (blueprint $table) {
      	$table->increments('id');
      	$table->char('username', 100);
      	$table->char('email', 100);
      	$table->char('password', 60);
      	$table->integer('user_type_id')->unsigned();
      	$table->boolean('is_deleted');
      	$table->integer('created_by_id')->unsigned();
      	$table->integer('updated_by_id')->unsigned();
      	$table->rememberToken();
      	$table->timestamps();

        $table->unique(['username']);
        $table->unique(['email']);
      	$table->foreign('user_type_id')->references('id_type')->on('syss_user_types')->onDelete('cascade');
      	$table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
      	$table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
      });

      DB::table('users')->insert([
      	['id' => '1','username' => 'admin','email' => 'admin@mail.com','password' => '$2y$10$JTOe0SbUINktfiI2iYEOEOSkmQN73gBThnKmB5JqLOt/37V8obTHm','user_type_id' => '1', 'is_deleted' => '0', 'created_by_id' => '1', 'updated_by_id' => '1'],
      ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
