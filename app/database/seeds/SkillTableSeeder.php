<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SkillTableSeeder extends Seeder {

	public function run()
	{
		Skill::truncate();
		Skill::create(['name'=>'PHP']);
		Skill::create(['name'=>'MySQL']);
		Skill::create(['name'=>'HTML']);
		Skill::create(['name'=>'CSS']);
		Skill::create(['name'=>'Javascript']);
		Skill::create(['name'=>'jQuery']);
		Skill::create(['name'=>'Java']);
		Skill::create(['name'=>'Android']);
		Skill::create(['name'=>'C++']);
		Skill::create(['name'=>'NodeJS']);

	}

}