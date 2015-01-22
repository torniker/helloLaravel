<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use pro\gateways\ProjectGateway;

class OffersTableSeeder extends Seeder {

	public function __construct(ProjectGateway $Projectgateway) {
		$this->Projectgateway = $Projectgateway;
	}

	public function run()
	{
		$faker = Faker::create();

	

		$projects = $this->Projectgateway->all(100)->toArray();
		$projects = array_fetch($projects,'id');

		foreach(range(1, 50) as $index)
		{
			Offer::create([
				'price' => $faker->randomFloat(2,0,1000000),
				'currency' => $faker->numberBetween(1,3),
				'project_id' => $faker->randomElement($projects)
			]);
		}
	}

}