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

	/**
	 * Show the form for creating a new resource.
	 * GET /offers/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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