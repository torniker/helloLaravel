<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class JobTableSeeder extends Seeder {

	public function run()
	{
		Job::truncate();
		$faker = Faker::create();
		$userids = array();
		$users=User::orderByRaw("RAND()")->get();
		foreach ($users as $user) {
			$userids[] = $user->id;
		}

		$headings = array(
			'მესაჭიროება PHP პროგრამისტი',
			'მესაჭიროება MySQL პროგრამისტი',
			'პროექტი ინტერფეისის დეველოპერთათვის',
			'პროექტი ვებ-დეველოპერთათვის',
			'ახალი სპორტული ვებსაიტი',
			'გვჭირდება Linux პროგრამისტი'
		 );

		foreach(range(1, 80) as $index)
		{
			$heading = $headings[array_rand($headings)];
			$content = $faker->text;
			$expires = $faker->date;
			$deadline = $faker->date;
			$price = $faker->randomNumber;
			$author = $userids[array_rand($userids)];
			$picture_id = rand(1,4);
			$picture = 'job'.$picture_id.'.jpg';

			Job::create([
				'heading'=>$heading,
				'content'=>$content,
				'expires'=>$expires,
				'deadline'=>$deadline,
				'price'=>$price,
				'author'=>$author,
				'website'=>'http://itdc.ge',
				'open'=>1,
				'picture'=>$picture
			]);
		}
	}

}