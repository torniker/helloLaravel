<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		User::truncate();
		$names = array(
			'მიხეილ',
			'ლაშა',
			'ალექსანდრე',
			'გიორგი',
			'დათო',
			'ავთანდილ',
			'ჯონი',
			'ვახტანგ'
			);
		$surnames = array(
			'აბრამიშვილი',
			'ჭელიძე',
			'გორგაძე',
			'სარიშვილი',
			'აბაშიძე',
			'შევარდნაძე',
			'სააკაშვილი',
			'ივანიშვილი'
			);

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

			$avatar_id = rand(1,4);
			$avatar = 'profile'.$avatar_id.'.jpg';

			User::create([
				'username'=>$name,
				'password' => Hash::make($name),
				'firstname'=>$names[array_rand($names)],
				'lastname'=>$surnames[array_rand($surnames)],
				'email'=>$faker->email(),
				'gender'=>$faker->numberBetween(0,1),
				'type'=>$type,
				'company_name'=>$company_name,
				'identification_code'=>$id_code,
				'avatar'=>$avatar
				]);
		}
	}

}