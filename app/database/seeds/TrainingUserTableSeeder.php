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
			if ($user->type==1) {
				$num = $faker->numberBetween(0, $training_num);
				$trainings = Training::orderByRaw('RAND()')->limit($num)->get();
				$tr = [];
				foreach($trainings as $training) {
					$tr[$training->id] = ['level' => $faker->numberBetween(1, 100)];
				}
				$user->trainings()->attach($tr);
			}
		}
	}

}