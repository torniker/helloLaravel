<?php namespace pro\gateways;

use pro\repositories\LoginRepository\LoginRepository;

class LoginGateway {

	private $loginRepo;

	public function __construct(LoginRepository $loginRepo) {
		$this->loginRepo = $loginRepo;
	}

	public function doLogin($input){
		return $this->loginRepo->doLogin($input);
	}
}