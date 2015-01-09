<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		User::truncate();
		 
		User::create([
			'username'=>'admin',
			'password' => Hash::make('admin'),
			'firstname'=>$faker->firstName(),
			'lastname'=>$faker->lastName(),
			'email'=>$faker->email(),
			'gender'=>$faker->numberBetween(0,1)
		]);

		foreach(range(1, 10) as $index)
		{
			$name = $faker->userName;
			User::create([
				'username'=>$name,
				'password' => Hash::make($name),
				'firstname'=>$faker->firstName(),
				'lastname'=>$faker->lastName(),
				'email'=>$faker->email(),
				'gender'=>$faker->numberBetween(0,1)
			]);
		}
	}
}