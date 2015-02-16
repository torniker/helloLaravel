<?php
use pro\gateways\OfferGateway;

class FreelancerOffersController extends \BaseController {

	public function __construct(OfferGateway $gateway){
		$this->gateway = $gateway;
	}

	/**
	 * Display a listing of the resource.
	 * GET /offers
	 *
	 * @return Response
	 */
	public function index()
	{
		$offers = $this->gateway->all(25);
		return View::make('freelancer.offers.index')->with('offers',$offers);
	}

 	
 	public function hire($project_id,$offer_id){
 		
 		$user_id = Auth::user()->id;
 		
 		$resp = $this->gateway->hire($user_id,$project_id,$offer_id);

 		if($resp){
 			Notification::success('Sucessfully hired!');
 		} else {
 			Notification::error('Something went wrong when hiring');
 		}

 		return Redirect::back();
 	}

	/**
	 * Store a newly created resource in storage.
	 * POST /offers
	 *
	 * @return Response
	 */
	public function store()
	{
		$params = Input::only(['project_id','message','price','currency']);

		if($this->gateway->create($params)){

			Notification::success('Offer is sent!');
		} else {
			Notification::error('Something went wrong!');
		}

		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 * GET /offers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /offers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /offers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /offers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}