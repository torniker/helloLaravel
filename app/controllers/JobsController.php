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
			return Redirect::to('');
		}
	}
	public function create(){
		$input=Input::all();
		$input['expires'] = $this->strtodate($input['expires']);
		$input['deadline'] = $this->strtodate($input['deadline']);
		$id = $this->gateway->create($input);
		$job=Job::find($id);

		if ( null !== Input::file('picture') ) {
			$hashedfilename=str_random(30).'.'.Input::file('picture')->guessClientExtension();
			Input::file('picture')->move('./public/uploads',$hashedfilename);
			$job->picture=$hashedfilename;
		}else{
			$job->picture='job3.jpg';
		}
			$job->save();

		return Redirect::to('dashboard');
	}

	public function strtodate($str){
		$parts = explode('/', $str);
		$date  = "$parts[2]-$parts[0]-$parts[1]";
		return $date;
	}

	public function show($id){
		$job=Job::find($id);
		$student=false;
		$bids=DB::table('job_user')
		->where('type', '1')
		->where('job_id', $id)
		->get();

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

		$comments=Comment::where('job_id', '=', $id)->where('replied_to', '=', 0)->get();
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
		$job=$input["job"];
		$student=Auth::user()->id;
		if (null !== Input::get('free')) {
			$bid=0;
		}else{
			$bid=$input["bid"];
		}

		$message = $this->gateway->apply($student,$job,$bid);
		
		return Redirect::to('jobs/show/'.$job)
		->with('msg', $message);;
	}

	public function choose(){
		$input = Input::all();
		$message = $this->gateway->choose($input);
		Session::flash('msg', "$message");
		return Redirect::back();
	}

	public function close(){
		$id = Input::get('job');
		$job = Job::find($id);
		if ($job->open==0) {
			Session::flash('msg', "პროექტი უკვე დახურულია");
		}else{
			$job->open=0;
			$job->save();
			Session::flash('msg', "პროექტი წარმატებით დაიხურა");
		}
		return Redirect::back();
	}

	public function myAll(){
		$user=Auth::user();
		$author =$user->id;
		$jobs = Job::where('author', '=', $author)
		->orderBy('id', 'DESC')->paginate(8);
		return View::make('users.dashboard')
		->with('user',$user)
		->with('jobs',$jobs);
	}

	public function myCompleted(){
		$user=Auth::user();
		$author =$user->id;
		$jobs = Job::whereHas('users', function($q) use ($author){
			$q->where('user_id', $author);
			$q->where('job_user.type', 3);
		})->orWhereHas('users', function($q) use ($author){
			$q->where('jobs.author', $author);
			$q->where('job_user.type', 3);})
			->orderBy('id', 'DESC')->paginate(8);

		return View::make('users.dashboard')
		->with('user',$user)
		->with('jobs',$jobs);
	}

	public function myOngoing(){
		$user=Auth::user();
		$author =$user->id;
		$jobs = Job::whereHas('users', function($q) use ($author){
			$q->where('job_user.user_id', $author);
			$q->where('job_user.type', 2);
		})->orWhereHas('users', function($q) use ($author){
			$q->where('jobs.author', $author);
			$q->where('job_user.type', 2);})
			->orderBy('id', 'DESC')->paginate(8);

		return View::make('users.dashboard')
		->with('user',$user)
		->with('jobs',$jobs);
	}

	public function myFailed(){
		$user=Auth::user();
		$author =$user->id;


		$jobs = Job::whereHas('users', function($q) use ($author){
			$q->where('user_id', $author);
			$q->where('job_user.type', 0);
		})->orWhereHas('users', function($q) use ($author){
			$q->where('jobs.author', $author);
			$q->where('job_user.type', 0);})
		->orderBy('id', 'DESC')->paginate(8);

		return View::make('users.dashboard')
		->with('user',$user)
		->with('jobs',$jobs);
	}

	public function failure($id){
		$user=Auth::user();
		$job = Job::find($id);
		if ($user->id==$job->author) {
			DB::table('job_user')
			->where('job_id', $id)
			->where('type', 2)
			->update(array('type' => 0));
			Session::flash('msg', "პროექტი ჩავარდა");
			return Redirect::back();
		}else{
			Session::flash('msg', "შენ არ ხარ ამ პროექტის ავტორი!");
			return Redirect::back();
		}
	}

	public function success($id){
		$user=Auth::user();
		$job = Job::find($id);
		if ($user->id==$job->author) {
			DB::table('job_user')
			->where('job_id', $id)
			->where('type', 2)
			->update(array('type' => 3));
			Session::flash('msg', "პროექტი წარმატებით დასრულდა, მადლობა!");
			return Redirect::back();
		}else{
			Session::flash('msg', "შენ არ ხარ ამ პროექტის ავტორი!");
			return Redirect::back();
		}
	}

	public function like($id){
		$user=Auth::user();
		$usId = $user->id;

		$result = DB::table('code_like')
		->where('user_id', $usId)
		->where('job_id', $id)
		->first();

		if(empty($result)){
			$job = Job::find($id);
			$counter = $job->rating+1;
			$job->rating = $job->rating+1;
			$job->save();

			DB::table('code_like')->insert(
			    array(
			    	'user_id' => $usId, 
			    	'job_id' => $id
			    )
			);
		}else{
			$job = Job::find($id);
			$counter = $job->rating;
		}

		return $counter;
		
	}

	public function delete($id){
		$user=Auth::user();
		if ($user->type==4) {
			$job = Job::find($id);
			$job->delete();
			DB::table('job_user')->where('job_id', '=', $id)->delete();
			Session::flash('msg', 'წარმატებით წაიშალა პროექტი');
		}
		return Redirect::back();
	}

	public function edit($id){
		$job=Job::find($id);
		return View::make('jobs.edit')
		->with('job',$job);
	}
	public function doedit($id){
		$user = Auth::user();
		if ($user->type==4) {
			$input=Input::all();
			$this->gateway->edit($input,$id);
			Session::flash('msg', 'პროექტი წარმატებით დარედაქტირდა');
		}
		return Redirect::to('dashboard');
	}
	
}
