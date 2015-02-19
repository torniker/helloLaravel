<?php 

namespace pro\gateways;

use pro\repositories\CourseRepository\CourseRepositoryInterface;

class CourseGateway {

	private $CourseRepo;

	public function __construct(CourseRepositoryInterface $CourseRepo) {
		$this->CourseRepo = $CourseRepo;
	}
 
	public function all() {
		return $this->CourseRepo->all();
	}

	public function byId($id) {
		return $this->CourseRepo->byId($id);

	}

	public function create($input) {
		return $this->CourseRepo->create($input);
	}
	
	public function update($id,$input) { 
		return $this->CourseRepo->update($id,$input);
	}

	public function delete($id){
		return $this->CourseRepo->delete($id);
	}
}