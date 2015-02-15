<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class JobUserTableSeeder extends Seeder {

	public function run()
	{
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

		DB::table('job_user')->truncate();
		
		foreach(range(1, 280) as $index)
		{
			$userid = array_rand($userids);
			$jobid = array_rand($jobids);
			$type = rand(0,3);

			$result = DB::table('job_user')
			->where('user_id', $userid)
			->where('job_id', $jobid)
			->where('type', $type)
			->first();

			if(empty($result)){
				DB::table('job_user')->insert(
					array(
						'user_id'=>$userid,
						'job_id'=>$jobid,
						'price'=>rand(2,2000),
						'type'=>$type
						)
					);
			}
		}
	}

}