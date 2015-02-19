<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		Comment::truncate();
		foreach(range(1, 100) as $index)
		{
			Comment::create([
				'project_id' => $faker->numberBetween(1,100),
				'user_id' => $faker->numberBetween(1,10),
				'message' => $faker->paragraph($faker->numberBetween(1,5))
			]);
		}
	}

}