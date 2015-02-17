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
		    $table->string('username')->unique();
		    $table->string('password');
		    $table->string('firstname');
		    $table->string('lastname');
		    $table->string('email');
		    $table->tinyInteger('gender');
		    $table->string('remember_token');
		    $table->tinyInteger('type');
		    $table->text('bio');
		    $table->timestamps();
		    $table->timestamp('deleted_at')->nullable();
		    $table->string('github_token')->nullable();
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
