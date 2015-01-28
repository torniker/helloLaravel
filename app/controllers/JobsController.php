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
				return View::make('jobs.add')
				->with('user',$user);
		}else{
			return Redirect::to('/');
		}
	}
	public function create(){
		$input=Input::all();
		$input['expires'] = $this->strtodate($input['expires']);
		$input['deadline'] = $this->strtodate($input['deadline']);
		$id = $this->gateway->create($input);

		if ( null !== Input::file('picture') ) {
			echo "here";
			$hashedfilename=str_random(30).'.'.Input::file('picture')->guessClientExtension();
			Input::file('picture')->move('./public/uploads',$hashedfilename);
			$job=Job::find($id);
			$job->picture=$hashedfilename;
			$job->save();
		}

		return Redirect::to('');
	}

	public function strtodate($str){
		$parts = explode('/', $str);
		$date  = "$parts[2]-$parts[0]-$parts[1]";
		return $date;
	}

	public function show($id){
		$job=Job::find($id);
		$student=false;
		$bids=DB::table('job_user')->where('type', '1')->get();

		$sorted_bids=array();
		foreach ($bids as $bid) {
			if ($bid->type==1) {
				$applicant = User::find($bid->user_id);
				$avatar = $applicant->avatar;
				$applicant = $applicant->firstname.' '. $applicant->lastname;
				$sorted_bids[] = array
					(
						'applicant_name' => $applicant,
						'applicant_id' => $bid->user_id,
						'avatar' => $avatar,
						'bid' => $bid->price,
					);
			}
		}
		usort($sorted_bids, function($a, $b){
			return $a["bid"] > $b["bid"];
		});


		if (Auth::check()){
			$user=Auth::user();
			if ($user->type==1){
				$student=true;
			}
		}

		$comments=Comment::where('job_id', '=', $id)->get();
		$usernames = array();
		$allusers = User::get();
		foreach ($allusers as $user) {
			$usernames[$user->id] = $user->firstname.' '.$user->lastname;
		}

		if ($student) {
			return View::make('jobs.show')
			->with('job',$job)
			->with('user',$user)
			->with('comments',$comments)
			->with('usernames',$usernames)
			->with('bids',$sorted_bids);;
		}else{
			return View::make('jobs.show')
			->with('job',$job)
			->with('comments',$comments)
			->with('usernames',$usernames)
			->with('bids',$sorted_bids);
		}
	}

	public function apply(){
		$jobs = Job::all();
		$input=Input::all();
		$student=Auth::user()->id;
		$job=$input["job"];
		$bid=$input["bid"];
		$message = $this->gateway->apply($student,$job,$bid);
		return Redirect::to('jobs/show/'.$job)
		->with('msg', $message);;
	}
	
}
