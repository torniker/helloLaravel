<?php
use pro\gateways\ClientGateway;

class ClientController extends BaseController {

	private $gateway;

	public function __construct(ClientGateway $gateway) {
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
		$this->gateway->doRegister($input);
	}
}
