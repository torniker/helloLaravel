<?php

use pro\gateways\LoginGateway;

class LoginController extends BaseController {

	public function __construct(LoginGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function showLogin()
	{
		if (Auth::check()){
			return Redirect::to('dashboard');
		}
		return View::make('users.login');
	}

	public function doLogin()
	{
		$input = Input::all();
		return $this->gateway->doLogin($input);
	}

	public function logOut(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function dashBoard(){
		session_start();
		$user=Auth::user();
		$author=$user->id;

		$ongoing = Job::whereHas('users', function($q) use ($author){
			$q->where('user_id', $author);
			$q->where('job_user.type', 2);
		})->orderBy('id', 'DESC')->get();

		$failed = Job::whereHas('users', function($q) use ($author){
			$q->where('user_id', $author);
			$q->where('job_user.type', 0);
		})->orderBy('id', 'DESC')->get();

		$completed = Job::whereHas('users', function($q) use ($author){
			$q->where('user_id', $author);
			$q->where('job_user.type', 3);
		})->orderBy('id', 'DESC')->get();

		$alljob = Job::whereHas('users', function($q) use ($author){
			$q->where('jobs.author', $author);
		})->orderBy('id', 'DESC')->get();

		$ongcounter = count($ongoing);
		$completed = count($completed);
		$failed = count($failed);
		$alljob = count($alljob);



		$_SESSION['ong'] = $ongcounter;
		$_SESSION['failed'] = $failed;
		$_SESSION['alljob'] = $alljob;
		$_SESSION['compl'] = $completed;



		$user=Auth::user();
		$user=User::with('phones')->find($user->id);
		$type=$user->type;
		$jobs = Job::orderBy('id', 'DESC')->paginate(6);
		return View::make('users.dashboard')
		->with('user',$user)
		->with('jobs',$jobs);
		
	}

	public function gitAuth(){
		session_start();
		return Github::gitAuth();
	}

	public function gitLogin(){
		session_start();
		return Github::gitLogin();
	}
}
