<?php namespace pro\repositories\UserRepository;

use User;
use Hash;
use Skill;
use DB;
use URL;
use Training;

class UserRepositoryDb implements UserRepositoryInterface {
	public function all() {
		return User::get();
	}

	public function byId($id) {
		return User::with('phones')->find($id);
	}

	public function create($input) {
		//file_put_contents('./text.txt', $input['type']);
		$user = new User;
		$trainings = $input['trainings'];
		$trlevels=$input['trlevel'];

		if ($input['type']==3) {
			$rule=array(
				'company_name'=>'required',
				'identification_code'=>'required'
				);
			$user->addRule($rule);
		}

		$user->fill($input);
		if (!empty($input['password'])) {
			$user->password = Hash::make($input['password']);
		}
		$user->color = "#".strtoupper(dechex(rand(0x000000, 0xFFFFFF)));
		$user->mainprofile=1;
		$user->save();
		$user=$user->find($user->id);
		$user->trainings()->attach($trainings);

		foreach ($trainings as $training) {
			$result = DB::table('training_user')
			->where('user_id', $user->id)
			->where('training_id', $training)
			->get();

			$trlevel = !empty($trlevels[$training])?$trlevels[$training]:0;

			if (empty($result)) {
				DB::table('training_user')->insert(
					array(
						'user_id' 	=> $user->id, 
						'training_id' 	=> $training,
						'level' 	=> $trlevel,
						)
					);
			}elseif($result[0]->level!=$trlevel){
				DB::table('training_user')
				->where('user_id', $user->id)
				->where('training_id', $training)
				->update(array('level' => $trlevel));
			}
		}




		return 1;
	}

	public function update_data($alldata,$data,$levels){
		
	}

	public function update($id,$input){
		$skills=$input['skill'];
		$trainings=$input['training'];
		$levels = $input['level'];
		$trlevels = $input['trlevel'];
			/**
				ჩაამატე სკილი მომხმარებელზე, თუ ის არ არსებობს ან ლეველი განსხვავებულია
			*/


				foreach ($skills as $skill) {
					$result = DB::table('skill_user')
					->where('user_id', $id)
					->where('skill_id', $skill)
					->get();

					$sklevel = !empty($levels[$skill])?$levels[$skill]:0;

					if (empty($result)) {
						DB::table('skill_user')->insert(
							array(
								'user_id' 	=> $id, 
								'skill_id' 	=> $skill,
								'level' 	=> $sklevel,
								)
							);
					}elseif($result[0]->level!=$sklevel){
						DB::table('skill_user')
						->where('user_id', $id)
						->where('skill_id', $skill)
						->update(array('level' => $sklevel));
					}
				}
			/**
				წაშალე სკილი მომხმარებლიდან, თუ ის აღარ უნდა არსებობდეს
			*/
				$allskills = Skill::get();
				foreach ($allskills as $skill) {
					if (!in_array($skill->id, $skills)) {
						$result = DB::table('skill_user')
						->where('user_id', $id)
						->where('skill_id', $skill->id)
						->get();
						if (!empty($result)) {
							DB::table('skill_user')
							->where('user_id', '=', $id)
							->where('skill_id', '=', $skill->id)
							->delete();
						}
					}
				}



				foreach ($trainings as $training) {
					$result = DB::table('training_user')
					->where('user_id', $id)
					->where('training_id', $training)
					->get();

					$trlevel = !empty($trlevels[$training])?$trlevels[$training]:0;

					if (empty($result)) {
						DB::table('training_user')->insert(
							array(
								'user_id' 	=> $id, 
								'training_id' 	=> $training,
								'level' 	=> $trlevel,
								)
							);
					}elseif($result[0]->level!=$trlevel){
						DB::table('training_user')
						->where('user_id', $id)
						->where('training_id', $training)
						->update(array('level' => $trlevel));
					}
				}
			/**
				წაშალე სკილი მომხმარებლიდან, თუ ის აღარ უნდა არსებობდეს
			*/
				$alltrainings = Training::get();
				foreach ($alltrainings as $training) {
					if (!in_array($training->id, $trainings)) {
						$result = DB::table('training_user')
						->where('user_id', $id)
						->where('training_id', $training->id)
						->get();
						if (!empty($result)) {
							DB::table('training_user')
							->where('user_id', '=', $id)
							->where('training_id', '=', $training->id)
							->delete();
						}
					}
				}






			/**
				დანარჩენი ოპერაციები
			*/
				$user = User::find($id);
				if(is_null($user)) {
					return Redirect::to('admin/user');
				}
				$user->fill($input);
				if($pass = $input['password']) {
					$user->password = Hash::make($pass);
				}
				$user->save();
			}
		}
