<?php

use pro\gateways\UserGateway;

class FreelancerProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /freelancerprofile
	 *
	 * @return Response
	 */
	public function __construct(UserGateway $Usergateway){
		$this->gateway = $Usergateway;
	}
	public function index()
	{
		$user = $this->gateway->currentUser();
		$githubData = $this->gateway->getGithubData();
		debug($githubData);
		return View::make('freelancer.profile.my')->with(['user'=>$user,'github'=>$githubData]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /freelancerprofile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$id = Auth::user()->id;
		if($this->gateway->update($id,Input::all())){
			Notification::success('Updated successfully');
		} else {
			Notification::error('Something went wrong!');
		}

		return Redirect::to('freelancer/profile');
	}

	public function show($id)
	{
		$user = $this->gateway->byId($id);
		$githubData = $this->gateway->getGithubData();
		debug($githubData);
		return View::make('freelancer.profile.show')->with(['user'=>$user,'github'=>$githubData]);
	}

	public function linkGithub(){
		$code = Input::get('code');

	    $github = OAuth::consumer('GitHub');


	    if (!empty($code)) {

	        if($token = $github->requestAccessToken($code)->getAccessToken()){
	        	$user = Auth::user();
	        	$this->gateway->update($user->id,['github_token'=>$token]);
	        	return Redirect::to('freelancer/profile');
	        }
	    }

        $url = $github->getAuthorizationUri();

         return Redirect::to((string)$url);

	}

	public function removeGithub(){
		$user = Auth::user();
		$this->gateway->update($user->id,['github_token'=>NULL]);

		return Redirect::to('freelancer/profile');
	}

}