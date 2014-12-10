<?php

class LoginController extends BaseController {

	public function dashBoard(){
		if (Auth::check()){
			$user=Auth::user();
			return View::make('users.dashboard')
			->with('user', $user);
		}
		else{
			return Redirect::to('/');
		}
	}

	public function showLogin()
	{
		if (Auth::check())
		{
    		return Redirect::to('dashboard');
		}
		/*if (Auth::viaRemember())
		{
    		var_dump(Auth::user());
		}*/
		return View::make('users.login');
	}

	public function doLogin()
	{
		$remember = false;

		$rules = array(
			'username'    => 'required', 
			'password' => 'required|min:3'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
				);
			$check = Input::get('remember');
			if (isset($check)) {
				$remember=true;
			}
			if (Auth::attempt($userdata,$remember)) {
				return Redirect::to('dashboard');
			} else {	 	
				return Redirect::to('login')
				->withInput(Input::except('password'))
				->with('message', 'მონაცემები არასწორია');
			}
		}
	}

	public function logOut(){
		Auth::logout();
		return Redirect::to('/');
	}
}
