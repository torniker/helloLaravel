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
		$this->call('TrainingTableSeeder');
		$this->call('TrainingUserTableSeeder');
		$this->call('PhoneTableSeeder');
		$this->call('JobTableSeeder');
		$this->call('CommentTableSeeder');
	}

}
