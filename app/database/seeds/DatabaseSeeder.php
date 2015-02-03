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
		$this->call('TrainingTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('SkillTableSeeder');
		$this->call('SkillUserTableSeeder');
		$this->call('TrainingUserTableSeeder');
		$this->call('PhoneTableSeeder');
		$this->call('JobTableSeeder');
		$this->call('CommentTableSeeder');
	}

}
