<?php namespace pro\gateways;

use pro\repositories\UserFrontendRepository;
use User;

class UserFrontendGateway {

	private $clientRepo;

	public function __construct(UserFrontendRepository $clientRepo) {
		$this->clientRepo = $clientRepo;
	}

	public function doRegister($input) {
		$user = new User;
		if ($input['type']==3) {
			$rule=array(
				'company_name'=>'required',
				'identification_code'=>'required'
				);
			$user->addRule($rule);
		}
		return $this->clientRepo->doRegister($input,$user);
	}

	public function doEdit($input){
		return $this->clientRepo->doEdit($input);
	}

	public function create($input) {
		return $this->clientRepo->create($input);
	}
}