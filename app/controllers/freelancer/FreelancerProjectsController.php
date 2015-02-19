<?php

use pro\gateways\ProjectGateway;

class FreelancerProjectsController extends \BaseController {

	public function __construct(ProjectGateway $gateway){
		$this->gateway = $gateway;
	}

	/**
	 * Display a listing of the resource.
	 * GET /projects
	 *
	 * @return Response
	 */
	public function index()
	{	
		$projects = $this->gateway->all();
		return View::make('freelancer.projects.index')->with('projects',$projects);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /projects/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('freelancer.projects.create');
	}
 
	/**
	 * Store a newly created resource in storage.
	 * POST /projects
	 *
	 * @return Response
	 */
	public function store()
	{
		$params = Input::only('title','body','expires');
		$params['user_id'] = Auth::user()->id;

		if($this->gateway->create($params)){
			Notification::success('Project was added!');
		} else {
			Notification::error('Something went wrong!');
		}
		

		return Redirect::to('freelancer/projects');
	}

	/**
	 * Display the specified resource.
	 * GET /projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$project = $this->gateway->byId($id);
		$total_projects_by_user = $project->user->projects()->count();
		$user_projects = $project->user->projects()->take(5)->get();

		return View::make('freelancer.projects.show')->with(['project'=>$project,'total_projects_by_user'=>$total_projects_by_user,'user_projects'=>$user_projects]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /projects/{id}/edit
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
	 * PUT /projects/{id}
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
	 * DELETE /projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function myprojects(){
		$projects = $this->gateway->getCurrentUserProjects();
		return View::make('freelancer.projects.my.index')->with('projects',$projects);  
	}

	public function myproject($id){
		$project = $this->gateway->byId($id);
		return View::make('freelancer.projects.my.show')->with('project',$project);  
	}
}