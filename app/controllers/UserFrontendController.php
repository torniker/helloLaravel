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
		return $this->gateway->doEdit($input);
	}

	public function show($id){
		$user = User::find($id);
		return View::make('users.user')
		->with('user',$user); 
	}
}
