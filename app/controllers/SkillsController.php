<?php

class SkillsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /skills
	 *
	 * @return Response
	 */
	public function index()
	{
		$skills = Skill::with('users')->get();
		return View::make('skills.index')->with('skills', $skills);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /skills/create
	 *
	 * @return Response
	 */
	public function create() 
	{
		return View::make('skills.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /skills
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Validator::make(Input::all(), array(
		    'name' => 'required',
		));

		if($validation->fails()){
			Notification::error($validator->messages()->all());
			return Redirect::to('skills/create')->withInput();  
		}

		$fields = array('name'=>Input::get('name'));

		$skill = Skill::create($fields);

		if($skill){ 
			Notification::success('Skill created');
		} else {
			Notification::error('Something went wrong!');
		}

		return Redirect::to('skills'); 

	} 
	
	/**
	 * Show the form for editing the specified resource.
	 * GET /skills/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /skills/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		echo 'update';
	}

}