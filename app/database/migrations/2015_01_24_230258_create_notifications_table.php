<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {
public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('to_user');
			$table->integer('project_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}

}
