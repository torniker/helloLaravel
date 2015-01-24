<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class JobTableSeeder extends Seeder {

	public function run()
	{
		Job::truncate();
		$faker = Faker::create();
		$userids = array();
		$users=User::All();
		foreach ($users as $user) {
			$userids[] = $user->id;
		}

		foreach(range(1, 80) as $index)
		{
			$heading = $faker->name;
			$content = $faker->text;
			$expires = $faker->date;
			$deadline = $faker->date;
			$price = $faker->randomNumber;
			$author = array_rand($userids);

			Job::create([
				'heading'=>$heading,
				'content'=>$content,
				'expires'=>$expires,
				'deadline'=>$deadline,
				'price'=>$price,
				'author'=>$author
			]);
		}
	}

}