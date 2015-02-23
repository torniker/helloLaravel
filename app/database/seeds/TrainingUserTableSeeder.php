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
				$count = 0;
				$num = $faker->numberBetween(0, $training_num);
				$trainings = Training::orderByRaw('RAND()')->limit($num)->get();
				$tr = [];
				foreach($trainings as $training) {
					$level = $faker->numberBetween(1, 100);
					$tr[$training->id] = ['level' => $level];
					$count+=$level;
				}
				$user->trainings()->attach($tr);
				$user->point=$count/6;
				$user->save();
			}
		}
	}

}