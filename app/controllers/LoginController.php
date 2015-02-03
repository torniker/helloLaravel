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
		if ($type==4) {
			return Redirect::to('admin/user');
		}
		else {
			$jobs = Job::orderBy('id', 'DESC')->get();
			return View::make('users.dashboard')
			->with('user',$user)
			->with('jobs',$jobs);
		}
	}

	public function gitAuth(){
		session_start();
		return Github::gitAuth();
	}

	public function gitLogin(){
		session_start();
		return Github::gitLogin();
	}
}
