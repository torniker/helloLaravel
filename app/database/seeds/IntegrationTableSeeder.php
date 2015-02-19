<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class IntegrationTableSeeder extends Seeder {

	public function run()
	{
		$sample_github_username_pool = ['jtleek','lrowe','lmello','linked','Blankwonder'];
		$faker = Faker::create();
		DB::table('integrations')->truncate();

		$users = User::all();

		foreach($users as $user) {
			$integrations = [];
			if($faker->numberBetween(0, 1)==0){
				$integrations = [
					new Integration([
						'service'=>'github',
						'username'=>$faker->randomElement($sample_github_username_pool)
					])
				];

				$user->integrations()->saveMany($integrations);
			}
		}
	}

}