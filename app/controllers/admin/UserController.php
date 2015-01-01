<?php
use pro\gateways\UserGateway;

class UserController extends BaseController {

	protected $layout = 'layouts.admin';
	private $gateway;

	public function __construct(UserGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function index()
	{
		$users = $this->gateway->all();
		return View::make('admin.users.index')->with('users', $users);
	}

	public function show($id) {
		$user = $this->gateway->byId($id);
		return View::make('admin.users.show')->with('user', $user);
	}

	public function create() {
		return View::make('admin.users.create');
	}

	public function store() {
		$input = Input::all();
		$this->gateway->create($input);

		Notification::success('User added successfully');

		return Redirect::to('admin/user');
	}

	public function edit($id) {
		$user = User::with('phones')->with('skills')->find($id);
		$skills = Skill::get();

		return View::make('admin.users.edit')->with(array(
			'user'=> $user,
			'skills'=> $skills
			));
	}

	public function update($id) {

		print_r($_POST);
		die();

		$user = User::find($id);
		if(is_null($user)) {
			return Redirect::to('admin/user');
		}

		$input = Input::all();

		$user->fill($input);
		if($pass = Input::get('password')) {
			$user->password = Hash::make($pass);
		}
		$user->save();

		Notification::success('User updated successfully');

		return Redirect::to('admin/user');
	}

	public function destroy($id) {
		$user = User::find($id);
		if(is_null($user)) {
			return Redirect::to('admin/user');
		}

		$user->delete();

		Notification::success('User deleted successfully');

		return Redirect::to('admin/user');
	}

}
