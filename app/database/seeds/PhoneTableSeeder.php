<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhoneTableSeeder extends Seeder {

	public function run()
	{
		Phone::truncate();
		$faker = Faker::create();
		$userids = array();
		$users=User::All();
		foreach ($users as $user) {
			$userids[] = $user->id;
		}
		foreach(range(1, 80) as $index)
		{
			$phone = $faker->phoneNumber;
			Phone::create([
				'phone'=>$phone,
				'user_id'=>array_rand($userids)
			]);
		}
	}

}