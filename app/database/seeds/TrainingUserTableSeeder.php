<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TrainingUserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$users = User::all();
		$training_num = Training::all()->count();
		DB::table('training_user')->truncate();
		foreach($users as $user) {
			$num = $faker->numberBetween(0, $training_num);
			$trainings = Training::orderByRaw('RAND()')->limit($num)->get();
			$tr = [];
			foreach($trainings as $training) {
				$tr[] = $training->id;
			}
			$user->trainings()->attach($tr);
		}
	}

}