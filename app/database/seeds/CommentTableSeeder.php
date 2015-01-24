<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CommentTableSeeder extends Seeder {

	public function run()
	{
		Comment::truncate();
		$faker = Faker::create();

		$userids = array();
		$jobids=array();

		$users=User::All();

		$jobs=Job::All();

		foreach ($users as $user) {
			$userids[] = $user->id;
		}

		foreach ($jobs as $job) {
			$jobids[] = $job->id;
		}

		foreach(range(1, 80) as $index)
		{
			$comment = $faker->text;
			Comment::create([
				'text'=>$comment,
				'user_id'=>array_rand($userids),
				'job_id'=>array_rand($jobids)
			]);
		}
	}

}