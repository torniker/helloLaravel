<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CoursesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Course::truncate();
		Course::create(['name'=>'Interface Developement']);
		Course::create(['name'=>'PHP & MySQL']);
	}

}