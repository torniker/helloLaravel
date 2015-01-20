<?php
use pro\gateways\UserGateway;

class UserController extends BaseController {

	protected $layout = 'layouts.admin';
	private $gateway;

	public function __construct(UserGateway $gateway) {
		$this->beforeFilter(function(){
			if (!Auth::check()){
				return Redirect::to('');
			}elseif(Auth::user()->type!=4){
				return Redirect::to('');
			}
		});
		$this->gateway = $gateway;
	}

	public function index(){
		$users = $this->gateway->all();
		return View::make('admin.users.index')->with('users', $users);
	}

	public function show($id) {
		$user = $this->gateway->byId($id);
		return View::make('admin.users.show')->with('user', $user);
	}

	public function create() {
		$trainings = Training::get();
		return View::make('admin.users.create')
		->with(
			[
			'trainings'=>$trainings
			]
		);
	}

	public function store() {
		$input = Input::all();
		if($this->gateway->create($input)){
			if (isset($input['token'])) {
				$token=$input['token'];
				$code = Code::where('code', '=', $token)->firstOrFail();
				$code->valid=0;
				$code->save();
			}
		}
		return Redirect::to('admin/user')
		->with('message_type','success')
		->with('message', 'User added successfully');
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
		$input=Input::all();

		if ( null !== Input::file('file') ) {
			$hashedfilename=str_random(30).'.'.Input::file('file')->guessClientExtension();
			Input::file('file')->move('./public/uploads',$hashedfilename);
			$user=User::find($id);
			$user->avatar=$hashedfilename;
			$user->save();
		}
		$this->gateway->update($id,$input);

		return Redirect::to('admin/user')
		->with('message_type','success')
		->with('message', 'User updated successfully');
	}

	public function destroy($id) {
		$user = User::find($id);
		if(is_null($user)) {
			return Redirect::to('admin/user');
		}

		$user->delete();
		return Redirect::to('admin/user')
		->with('message_type','success')
		->with('message', 'User deleted successfully');
	}

}
