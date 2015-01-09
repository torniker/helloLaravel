<?php
class AuthController extends BaseController {

	public function getLogin(){
		return View::make('auth.login');
	}

	public function postLogin(){
		
		$validator = Validator::make(
			Input::all(),
		    array(
		        'username' => 'required',
		        'password' => 'required',
		    )
		);

		if($validator->fails()){
			Notification::error($validator->messages()->all());
		} else {

			$fields = Input::only('username','password');
		
			if(Auth::attempt($fields)){
				Notification::success('You have been logged in!');
				return Redirect::to('/');
			} else {
				Notification::error('Username / Password is not correct');
			}
		}

		return Redirect::back()->withInput();
	}

	public function getLogout(){
		Auth::logout();
		Notification::info('You have been logged out!');
		return Redirect::to('/');
	}
}
?>