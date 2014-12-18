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
	public function doEdit(){
		$rules = array(
			'username'    => 'required|min:3', 
			'firstname' => 'required|min:3|alpha',
			'lastname' => 'required|min:3|alpha'
			);
		$validator = Validator::make(Input::all(), $rules);
		if (!$validator->fails()){
			$data = Input::all();
			$id = $data['id'];
			$user = User::find($id);
			$user->username=$data['username'];
			$user->firstname=$data['firstname'];
			if (!empty($data['password'])) {
				$user->password=Hash::make($data['password']);
			}
			$user->save();
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('editprofile')
			->withErrors($validator)
			->withInput(Input::except('password'));
		}
	}
}