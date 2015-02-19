<?php 

namespace pro\gateways;

use pro\repositories\ProjectRepository\ProjectRepositoryInterface;
use Auth;
use Project;

class ProjectGateway {

	private $ProjectRepo;

	public function __construct(ProjectRepositoryInterface $ProjectRepo) {
		$this->ProjectRepo = $ProjectRepo;
	}
 
	public function all($perpg = 25) {
		return $this->ProjectRepo->all($perpg);
	}

	public function byId($id) {
		return $this->ProjectRepo->byId($id);

	}

	public function create($input) {
		$input['expires'] = date('Y-m-d H:i:s', strtotime(sprintf(date('Y-m-d H:i:s'). ' + %d days',$input['expires'])));
		$project = new Project;
		validate($input,$project->rules['creating']);
		return $this->ProjectRepo->create($input);
	}
	
	public function update($id,$input) { 
		return $this->ProjectRepo->update($id,$input);
	}

	public function delete($id){
		return $this->ProjectRepo->delete($id);
	}

	public function getProjectsWhere($oldWhere=[]){
		$where = [];

		foreach ($oldWhere as $key => $cond) {
			if(is_array($cond)){
				
				$elNum = count($cond);

				if($elNum==3){
					$where[] = [$cond[0],$cond[1],$cond[2]];
				}

				if($elNum==2){
					$where[] = [$cond[0],'=',$cond[1]];
				}
			}
		}
		
		return $this->ProjectRepo->getProjectsWhere($where);
	}

	public function getCurrentUserProjects(){
		$user = Auth::user();
		return $this->ProjectRepo->ByUserId($user->id);
	}
}