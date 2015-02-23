<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TrainingTableSeeder extends Seeder {

	public function run()
	{
		Training::truncate();
		Training::create(['name'=>'ვებ პროგრამირება']);
		Training::create(['name'=>'ინტერფეისი']);
		Training::create(['name'=>'ვებ დიზაინი']);
		Training::create(['name'=>'ვებ ადმინისტრირება']);
		Training::create(['name'=>'ინტერნეტ მარკეტინგი']);
		Training::create(['name'=>'Linux ადმინისტრირება']);
	}

}