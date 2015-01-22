<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use pro\gateways\UserGateway;
use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder {

	public function __construct(UserGateway $Usergateway) {
		$this->Usergateway = $Usergateway;
	}

	public function run()
	{
		Project::truncate();
		
		$faker = Faker::create();
		$users = $this->Usergateway->getUsersWhere([['type',1]])->toArray();
		$users = array_fetch($users,'id');

		foreach(range(1, 100) as $index)
		{
			Project::create([
				'title' => $faker->sentence($faker->numberBetween(5,10)),
				'body'	=> $faker->paragraph($faker->numberBetween(10,20)),
				'expires' => '2015-04-25 08:37:17',
				'user_id' => $faker->randomElement($users)
			]);
		}
	}

}