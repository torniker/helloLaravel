<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CourseUserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$users = User::all();

		$course_num = Course::all()->count();

		DB::table('course_user')->truncate();

		foreach($users as $user) {
			$num = $faker->numberBetween(0, $course_num);
			$courses = Course::orderByRaw('RAND()')->limit($num)->get();
			$co = [];
			foreach($courses as $course) {
				$co[$course->id] = ['score'=>$faker->numberBetween(0, 100)];
			} 
			$user->courses()->attach($co);
		}
	}

}