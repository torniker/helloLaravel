<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	/******* define layout ********/
	public function __construct()
    	{
        	$this->layout = 'layouts.master';
	}

    /******* get all users with skills ********/
	public function index()
	{
		$users = User::with('skills')->paginate(30);
		$skills = Skill::all();
		return View::make('home.index', ['users' => $users, 'skills' => $skills, 'tagname' => []]);
	}

	/******* filter users by skills ********/
	public function filterSkills(){
		$input = Input::all();
		$skills = Skill::all();
		$langArr = [];
		if (count($input) < 2) {
			$users = User::with('skills')->paginate(30);
			return View::make('home.index', ['users' => $users, 'skills' => $skills, 'tagname' => []]);
		}
		
		foreach ($input as $k => $v) {
			if ($k != '_token') {
				$langArr[] = $k;
			}
		}

		$users = User::whereHas('skills', function($q) use($langArr)
		{
			$q->whereIn('name', $langArr);
		}, '=', count($langArr))->with('skills')->paginate(30);
		
		return View::make('home.index', ['users' => $users, 'skills' => $skills, 'tagname' => $langArr]);
	}

	/******* filter users by tag ********/
	public function byTag($tag){
		$skills = Skill::all();
		$users = User::whereHas('skills', function($q) use($tag)
		{
			$q->where('name','=', $tag);
		})->with('skills')->paginate(30);

		return View::make('home.index', ['users' => $users, 'skills' => $skills, 'tagname' => [$tag]]);
	}
}

?>
