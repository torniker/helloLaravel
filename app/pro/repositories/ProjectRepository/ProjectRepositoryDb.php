<?php

namespace pro\repositories\ProjectRepository;

use Project;
class ProjectRepositoryDb implements ProjectRepositoryInterface {


	public function all($perpg = 25) {
		$projects = Project::with('user')->get();
		debug($projects);
		return $projects;
	}

	public function byId($id) {
		return Project::find($id);
	}

	public function create($input) {

	}

	public function update($id,$input){

	}

	public function delete($id){
		$project = $this->byId($id);
		
		if($project->delete()){
			return true;
		}

		return false;

	} 

	public function getProjectsWhere($where){
		$projects = new Project;

		foreach ($where as $key => $condition) {
			$projects = $projects->where($condition[0],$condition[1],$condition[2]);
		}

		return $projects->get();
	}

	public function byUserId($id,$perpg = 25){ 
		return Project::with('user')->where('user_id',$id)->paginate($perpg); 
	}

}
 