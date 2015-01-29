<?php

namespace pro\gateways;

use pro\repositories\UserRepository\UserRepositoryInterface;
use Auth;
class UserGateway {

	private $userRepo;

	public function __construct(UserRepositoryInterface $userRepo) {
		$this->userRepo = $userRepo;
	}

	public function all() {
		return $this->userRepo->all();
	}

	public function byId($id) {
		return $this->userRepo->byId($id);
	}

	public function currentUser(){
		return $this->userRepo->currentUser();
	}

	public function create($input) {
		return $this->userRepo->create($input);
	}
	public function getGithubData($user = false){
		if(!$user){
			$user = Auth::user();
		}

		if(is_null($user->github_token)){
			return false;
		}

		return $this->userRepo->getGithubData($user->github_token);
	}
	public function update($id,$input) {
		$courses = [];

		if(isset($input['course'])){
			foreach ($input['course'] as $key => $course_id) {
				$courses[$course_id] = ['score'=>$input['score'][$course_id]];
			}
		}

		return $this->userRepo->update($id,$input,$courses);
	}

	public function getUsersWhere($oldWhere=[]){
		$where = [];

		foreach ($oldWhere as $key => $cond) {
			if(is_array($cond)){

				$elNum = count($cond);

				if($elNum==3){
					$where[] = [$cond[0],$cond[1],$cond[2]];
				}

				if($elNum==2){
					$where[] = [$cond[0],'=',$cond[1]];
				}
			}
		}

		return $this->userRepo->getUsersWhere($where);
	}
}