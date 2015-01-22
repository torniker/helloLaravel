<?php

namespace pro\repositories\UserRepository;

use User;
use Hash;

class UserRepositoryDb implements UserRepositoryInterface {


	public function all() {
		$users = User::with('courses')->paginate(10);
		return $users;
	}

	public function byId($id) {
		return User::with('phones')->with('skills')->with('courses')->with('integrations')->find($id);
	}

	public function create($input) {
	    $user = new User;
		$user->fill($input);
		$user->password = Hash::make($input['password']);
		$user->username = $input['email'];
		$user = $user->save();
		return $user;
	}

	public function update($id,$input,$courses = false){
		$user = $this->byId($id);
		
		if($input['password']!='') {
			$user->password = Hash::make($pass);
		} else {
			unset($input['password']);
		}

		$user->fill($input);
		
		if(is_array($courses)){
			$user->courses()->sync($courses);
		}
		
		if($user->save()){
			return true;
		}

		return false;
	}

	public function getUsersWhere($where){
		$users = new User;

		foreach ($where as $key => $condition) {
			$users = $users->where($condition[0],$condition[1],$condition[2]);
		}

		return $users->get();
	}
}
 