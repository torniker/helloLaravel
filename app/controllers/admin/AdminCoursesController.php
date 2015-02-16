<?php

use pro\gateways\CourseGateway;

class AdminCoursesController extends \BaseController {

	/** 
	 * Display a listing of the resource.
	 * GET /courses
	 *
	 * @return Response
	 */
	public function __construct(CourseGateway $gateway){
		$this->gateway = $gateway;
	}

	public function index()
	{
		$courses = $this->gateway->all();
		return View::make('admin.courses.index')->with('courses', $courses);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /courses/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.courses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /courses
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->gateway->create(Input::only(['name'])); 
		return Redirect::to('admin/course');
	}

	/**
	 * Display the specified resource.
	 * GET /courses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /courses/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$course = $this->gateway->byId($id);

		return View::make('admin.courses.edit')->with(['course'=>$course]); 
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /courses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$this->gateway->update($id,Input::only(['name']));
		return Redirect::to('admin/course');  
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /courses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->gateway->delete($id);
		return Redirect::to('admin/course'); 
	} 

}