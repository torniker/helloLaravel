<?php namespace pro\gateways;

use pro\repositories\LoginRepository\LoginRepository;

class LoginGateway {

	private $loginRepo;

	public function __construct(LoginRepository $loginRepo) {
		$this->loginRepo = $loginRepo;
	}

	public function doLogin($input){
		$rules = array(
			'username'    => 'required', 
			'password' => 'required|min:3'
			);
		return $this->loginRepo->doLogin($input,$rules);
	}
}