<?php
class HomeController extends BaseController {
	public function index()
	{
		$users = User::where('type', '=', '1')->with('skills')->with('trainings')->get();
		return View::make('home.index')->with('users', $users);
	}
	public function editProfile($gituser = NULL){
		$user=Auth::user();
		return View::make('users.edit')->with('user', $user)->with('gituser',$gituser); 
	}
}