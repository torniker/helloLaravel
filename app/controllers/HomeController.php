<?php
class HomeController extends BaseController {
	public function index()
	{
		if (!empty($_POST)) {
			$input = Input::all();
			$skills = $input['skill'];
			$levels = $input['level'];
			$wanted_users = array();
			// foreach ($skills as $skill) {
			// 	$result = DB::table('skill_user')
			// 		  ->where('skill_id', $skill)
			// 		  ->where('level','>',$levels[$skill])
			// 		  ->get();
			// 	foreach ($result as $user) {
			// 		if (!in_array($user->user_id,$wanted_users)) {
			// 			$wanted_users[]=$user->user_id;
			// 		}
			// 	}
			// }
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