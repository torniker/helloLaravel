<?php 

namespace pro\repositories\UserRepository;

use User;
use Hash;

class UserRepositoryDb implements UserRepositoryInterface {


	public function all() {
		return User::get();
	}

	public function byId($id) {
		return User::with('phones')->with('skills')->with('integrations')->find($id);
	}

	public function create($input) {
	    $user = new User;
		$user->fill($input);
		$user->password = Hash::make($input['password']);
		$user->username = $input['email'];
		$user = $user->save();
		return $user;
	}
}
