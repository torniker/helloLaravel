<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('SkillTableSeeder');
		$this->call('SkillUserTableSeeder');
		$this->call('CoursesTableSeeder');
		$this->call('CourseUserTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('OffersTableSeeder');
		$this->call('CommentsTableSeeder');
	}

}
