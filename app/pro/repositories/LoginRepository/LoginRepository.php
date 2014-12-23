<?php namespace pro\repositories\LoginRepository;

use Validator;
use Auth;
use Redirect;

class LoginRepository {
	public function doLogin($input,$rules){
		$remember = false;
		$validator = Validator::make($input, $rules);
		if ($validator->fails()) {
			return Redirect::to('login')
			->withErrors($validator)->with('oldUser',$input['username']);
		} else {
			$userdata = array(
				'username' 	=> $input['username'],
				'password' 	=> $input['password'],
				);
			if (isset($input['remember'])) {
				$remember=true;
			}
			if (Auth::attempt($userdata,$remember)) {
				return Redirect::to('dashboard');
			} else {	 	
				return Redirect::to('login')
				->with('message', 'მონაცემები არასწორია')
				->with('oldUser',$input['username']);
			}
		}
	}
}
