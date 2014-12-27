<?php
use pro\gateways\UserFrontendGateway;

class UserFrontendController extends BaseController {

	private $gateway;

	public function __construct(UserFrontendGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function register(){
		return View::make('clients.register'); 
	}
	public function doRegister(){
		$input=Input::all();
		return $this->gateway->doRegister($input);
	}



	
	public function dashBoard(){
		 if($this->checkClient()){
		 	return View::make('clients.dashboard'); 
		}
	}

	private function checkClient(){
		if (Auth::user()->type==2 || Auth::user()->type==3){
			return true;
		}
	}

	public function doEdit(){
		$input=Input::all();
		return $this->gateway->doEdit($input);
	}
}
