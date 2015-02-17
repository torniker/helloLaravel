<?php

namespace pro\repositories\UserRepository;

use User;
use Hash;
use Auth;
use Guzzle;

class UserRepositoryDb implements UserRepositoryInterface {


	public function all() {
		$users = User::with('courses')->paginate(10);
		return $users;
	}

	public function byId($id) {
		debug('byid');
		return User::with(['offers'=>function($query){ $query->where('status', '=', '3'); }])->with(['courses','integrations'])->find($id);
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

		if(isset($input['password']) AND $input['password']!='') {
			$user->password = Hash::make($input['password']);
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

	public function currentUser(){
		return $this->byId(Auth::user()->id);
	}

	public function getGithubData($token){
		$client = new \Guzzle\Service\Client('https://api.github.com/');

		$resp = $client->get(sprintf('/user?access_token=%s',$token))->send()->json();
		return $resp;
	}
}
