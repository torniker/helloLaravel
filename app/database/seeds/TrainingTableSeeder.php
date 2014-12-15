<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TrainingTableSeeder extends Seeder {

	public function run()
	{
		Training::truncate();
		Training::create(['name'=>'Web Development']);
		Training::create(['name'=>'Interface Development']);
		Training::create(['name'=>'Web Design']);
		Training::create(['name'=>'Web Administration']);
		Training::create(['name'=>'Linux System Administration']);
		Training::create(['name'=>'Internet Marketing']);
	}

}