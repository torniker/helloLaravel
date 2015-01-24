<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text');
			$table->integer('user_id');
			$table->integer('job_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}

}
