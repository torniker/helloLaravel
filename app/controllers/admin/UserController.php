<?php
class UserController extends BaseController {

	protected $layout = 'layouts.admin';

	public function getIndex()
	{
		$users = User::all();
		return View::make('admin.users.index')->with('users', $users);
	}

}
