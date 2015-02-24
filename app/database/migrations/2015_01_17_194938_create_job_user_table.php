<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobUserTable extends Migration {

	public function up()
	{
		Schema::create('job_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('job_id');
			$table->integer('price');
			$table->tinyInteger('type'); 
			$table->unique( array('user_id','job_id','type'));
			//1 - bid pending, 2 - approved, 3 - completed, 0-failed
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('job_user');
	}

}
