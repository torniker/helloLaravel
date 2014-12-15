<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SkillUserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$users = User::all();
		$skill_num = Skill::all()->count();
		DB::table('skill_user')->truncate();
		foreach($users as $user) {
			if ($user->type==1) {
				$num = $faker->numberBetween(0, $skill_num);
				$skills = Skill::orderByRaw('RAND()')->limit($num)->get();
				$sk = [];
				foreach($skills as $skill) {
					$sk[$skill->id] = ['level' => $faker->numberBetween(1, 100)];
				}
				$user->skills()->attach($sk);
			}
		}
	}

}