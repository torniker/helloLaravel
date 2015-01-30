<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->tinyInteger('type');
		    $table->string('username')->unique();
		    $table->string('password');
		    $table->string('firstname');
		    $table->string('lastname');
		    $table->string('email');
		    $table->tinyInteger('gender');
		    $table->string('avatar');
		    $table->string('github');
		    $table->string('facebook');
		    $table->string('remember_token');
		    $table->timestamps();
		    $table->timestamp('deleted_at')->nullable();
		    $table->string('company_name');
		    $table->string('identification_code');
		});
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
