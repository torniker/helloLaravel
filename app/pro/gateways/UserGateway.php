<?php namespace pro\gateways;

use pro\repositories\UserRepository\UserRepositoryInterface;

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

	public function create($input) {
		return $this->userRepo->create($input);
	}
}