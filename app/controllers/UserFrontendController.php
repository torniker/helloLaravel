<?php
use pro\gateways\UserFrontendGateway;

class UserFrontendController extends BaseController {

	private $gateway;

	public function __construct(UserFrontendGateway $gateway) {
		$this->beforeFilter(function(){
			if (Auth::check()){
				return Redirect::to('/');
			}
		});
		$this->gateway = $gateway;
	}

	public function register(){
		return View::make('clients.register'); 
	}
	public function doRegister(){
		$input=Input::all();
		return $this->gateway->doRegister($input);
	}
}
