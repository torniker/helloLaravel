<?php

namespace pro\repositories\CourseRepository;

use Course;

class CourseRepositoryDb implements CourseRepositoryInterface {


	public function all() {
		$course = Course::all();
		return $course;
	}

	public function byId($id) {
		return Course::find($id);
	}

	public function create($input) {
	    $course = new Course;
	    $course->name = $input['name'];
	    $course->save();
		return $course;
	}

	public function update($id,$input){
		$course = $this->byId($id);
		$course->fill($input);
		$course->save();

		return $course;
	}

	public function delete($id){
		$course = $this->byId($id);
		
		if($course->delete()){
			return true;
		}

		return false;

	}
}
 