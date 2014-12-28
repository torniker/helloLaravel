<?php
class HomeController extends BaseController {
	public function index()
	{
		if (!empty($_POST)) {
			$input = Input::all();
			$skills = $input['skill'];
			$levels = $input['level'];
			$wanted_users = array();
			
			foreach ($skills as $skill) {
				$requirements[$skill]=$levels[$skill];
			}
			$users = User::query();

			foreach($requirements as $id => $value){
				$users->whereHas('skills', function($q) use ($id, $value){
					$q->where('skill_id', $id);
					$q->where('level', '>', $value);
				});
			}

			$users = $users->get();

			foreach ($users as $user) {
				$wanted_users[]=$user->id;
			}
			if (!empty($wanted_users)) {
				$data = User::whereIn('id', $wanted_users)->get();
				$skills = Skill::get();
				return View::make('home.index')
				->with('users', $data)
				->with('skills', $skills);
			}
			
		}else{
			$users = User::where('type', '=', '1')->with('skills')->with('trainings')->get();
			$skills = Skill::get();
			return View::make('home.index')
			->with('users', $users)
			->with('skills', $skills);
		}
	}
	public function editProfile($gituser = NULL){
		$user=Auth::user();
		return View::make('users.edit')->with('user', $user)->with('gituser',$gituser); 
	}
}