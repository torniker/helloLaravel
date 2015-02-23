<?php
use pro\gateways\UserFrontendGateway;

class UserFrontendController extends BaseController {

	private $gateway;

	public function __construct(UserFrontendGateway $gateway) {
		$this->gateway = $gateway;
	}

	public function register(){
		return View::make('clients.register'); 
	}

	
	public function stud_register(){
		if(isset($_GET['token'])){
			$token=$_GET['token'];
			try{
				$code = Code::where('code', '=', $token)->firstOrFail();
				if ($code->valid==1) {
					$trainings = Training::get();
					return View::make('users.register')
					->with(
						[
						'trainings'=>$trainings
						]
						);
				}else{
					echo '<div style="float:left; margin-left:400px">ეს კოდი უკვე გამოყენებულია</div>';
				}
			}
			catch(Exception $e){
				echo '<div style="float:left; margin-left:400px">ეს კოდი არაა ვალიდური</div>';
			}
		}else{
			echo '<div style="float:left; margin-left:400px">რეგისტრაცია ხდება მხოლოდ ტოკენების საშუალებით</div>';
		}
	}


	public function doRegister(){
		$input=Input::all();
		return $this->gateway->doRegister($input);
	}
	
	public function dashBoard(){
		if($this->checkClient()){
			return View::make('clients.dashboard'); 
		}
	}

	private function checkClient(){
		if (Auth::user()->type==2 || Auth::user()->type==3){
			return true;
		}
	}

	public function doEdit(){
		$input=Input::all();
		$id = $input['id'];
		if ( null !== Input::file('file') ) {
			$hashedfilename=str_random(30).'.'.Input::file('file')->guessClientExtension();
			Input::file('file')->move('./public/uploads',$hashedfilename);
			$user=User::find($id);
			$user->avatar=$hashedfilename;
			$user->save();
		}
		return $this->gateway->doEdit($input);
	}

	public function show($id){
		$user = User::find($id);
		return View::make('users.user')
		->with('user',$user); 
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
		
		return Redirect::to('')
		->with('message_type','success')
		->with('message', 'User added successfully');
	}

	public function filter($id){
		$users = User::whereHas('trainings', function($q) use ($id){
		    $q->where('training_id', $id);
		})->paginate(8);
		$skills = Skill::get();

		return View::make('home.index')
			->with('users', $users)
			->with('skills', $skills);
	}

}
