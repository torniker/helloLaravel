<?php

use pro\gateways\LoginGateway;

class LoginController extends BaseController {

	public function __construct(LoginGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function showLogin()
	{
		if (Auth::check()){
			return Redirect::to('dashboard');
		}
		return View::make('users.login');
	}

	public function doLogin()
	{
		$input = Input::all();
		return $this->gateway->doLogin($input);
	}

	public function logOut(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function dashBoard(){
		$user=Auth::user();
		$user=User::with('phones')->find($user->id);
		$type=$user->type;
		if ($type==1) {
			return View::make('users.dashboard')->with('user',$user);
		}elseif($type==2||$type==3){
			return View::make('clients.dashboard')->with('user',$user);
		}else{
			return Redirect::to('admin/user');
		}
	}

	public function github(){
		session_start();
		return Github::gitLogin();
	}
}
