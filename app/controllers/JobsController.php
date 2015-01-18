<?php
use pro\gateways\JobsGateway;

class JobsController extends BaseController {

	private $gateway;

	public function __construct(JobsGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function index(){
		$jobs = Job::all();
		return View::make('jobs.index')
		->with('jobs',$jobs);
	}
	public function add(){
		if (Auth::check()) {
			$user=Auth::user();
			if ($user->type==1) {
				return Redirect::to('/');
			}else{
				return View::make('jobs.add')
				->with('user',$user);
			}
		}else{
			return Redirect::to('/');
		}
	}
	public function create(){
		$input=Input::all();
		$this->gateway->create($input);
		return Redirect::to('');
	}

	public function show($id){
		$job=Job::find($id);
		$student=false;
		if (Auth::check()){
			$user=Auth::user();
			if ($user->type==1){
				$student=true;
			}
		}
		if ($student) {
			return View::make('jobs.show')
			->with('job',$job)
			->with('user',$user);
		}else{
			return View::make('jobs.show')
			->with('job',$job);
		}
	}

	public function apply(){
		$jobs = Job::all();
		$input=Input::all();
		$student=$input["applicant"];
		$job=$input["job"];
		$message = $this->gateway->apply($student,$job);
		return View::make('jobs.index')
		->with('jobs',$jobs)
		->with('message',$message);
	}
	
}
