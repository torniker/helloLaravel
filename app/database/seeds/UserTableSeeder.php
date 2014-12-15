<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		User::truncate();

		foreach(range(1, 30) as $index)
		{
			$name = $faker->userName;
			$type = $faker->numberBetween(1,4);
			$company_name = -1;
			$id_code = -1;

			if ($type==3) {
				$company_name = $faker->company;
				$id_code = $faker->uuid;
			}

			User::create([
				'username'=>$name,
				'password' => Hash::make($name),
				'firstname'=>$faker->firstName(),
				'lastname'=>$faker->lastName(),
				'email'=>$faker->email(),
				'gender'=>$faker->numberBetween(0,1),
				'type'=>$type,
				'company_name'=>$company_name,
				'identification_code'=>$id_code
			]);
		}
	}

}