<?php namespace pro\repositories\UserRepository;

use User;
use Hash;
use Skill;
use DB;

class UserRepositoryDb implements UserRepositoryInterface {
	public function all() {
		return User::get();
	}

	public function byId($id) {
		return User::with('phones')->find($id);
	}

	public function create($input) {
	    $user = new User;
		$user->fill($input);
		$user->password = Hash::make($input['password']);
		$user->username = $input['email'];
		$user = $user->save();
		return $user;
	}

	public function update($id,$input){
			$skills=$input['skill'];
			$levels = $input['level'];
			/**
				ჩაამატე სკილი მომხმარებელზე, თუ ის არ არსებობს ან ლეველი განსხვავებულია
			*/
			foreach ($skills as $skill) {
				$result = DB::table('skill_user')
				->where('user_id', $id)
				->where('skill_id', $skill)
				->get();

				$sklevel = !empty($levels[$skill])?$levels[$skill]:0;

				if (empty($result) || $result[0]->level!=$sklevel) {
					DB::table('skill_user')->insert(
						array(
							'user_id' 	=> $id, 
							'skill_id' 	=> $skill,
							'level' 	=> $sklevel,
							)
						);
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
