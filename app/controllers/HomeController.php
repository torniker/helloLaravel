<?php

class HomeController extends BaseController {

	public function index()
	{
		$users = User::with('skills')->get();
		return View::make('home.index')->with('users', $users);
	}

}
