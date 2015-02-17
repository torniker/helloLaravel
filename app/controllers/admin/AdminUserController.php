<?php
use pro\gateways\UserGateway;
use pro\gateways\GithubGateway;
use pro\gateways\CourseGateway;

class AdminUserController extends BaseController {

	// protected $layout = 'layouts.admin';


	public function __construct(UserGateway $Usergateway,GithubGateway $GithubGateway,CourseGateway $CourseGateway) {
		$this->Usergateway = $Usergateway;
		$this->GithubGateway = $GithubGateway;
		$this->CourseGateway = $CourseGateway;
	}

	public function index()
	{
		$users = $this->Usergateway->all();
		return View::make('admin.users.index')->with('users', $users);
	}

	public function show($id) {
		$user = $this->Usergateway->byId($id);
		$githubData = false;

		$githubIntegration = Integration::where('user_id',$user->id)->where('service','github')->get();
		
		if(!$githubIntegration->isEmpty()){
			$githubUsername = $githubIntegration->first()->username;
			$githubData = $this->GithubGateway->getUser($githubUsername);
		}

		return View::make('admin.users.show')->with(['user'=> $user,'github'=>$githubData]);
	}

	public function create() {
		return View::make('admin.users.create');
	}

	public function store() {
		$input = Input::all();
		$this->Usergateway->create($input);

		Notification::success('User added successfully');

		return Redirect::to('admin/user');
	}

	public function edit($id) {
		$user = $this->Usergateway->byId($id);
		$courses = $this->CourseGateway->all();
		
		return View::make('admin.users.edit')->with([
			'user'=> $user,
			'courses' => $courses
		]);
	}

	public function update($id) {
		
		if($this->Usergateway->update($id,Input::all())){
			Notification::success('User updated successfully');
		} else {
			Notification::error('Something went wrong!');
		}

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
