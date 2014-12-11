<?php namespace pro\repositories\LoginRepository;

use Validator;
use Auth;
use Redirect;

class LoginRepository {

	public function doLogin($input){
		$remember = false;

		$rules = array(
			'username'    => 'required', 
			'password' => 'required|min:3'
			);
		$validator = Validator::make($input, $rules);

		if ($validator->fails()) {
			return 'validationError';
		} else {
			$userdata = array(
				'username' 	=> $input['username'],
				'password' 	=> $input['password']
				);
			if (isset($input['remember'])) {
				$remember=true;
			}
			if (Auth::attempt($userdata,$remember)) {
				return 'success';
			} else {	 	
				return 'dataError';
			}
		}
	}
}
