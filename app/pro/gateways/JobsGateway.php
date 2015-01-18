<?php namespace pro\gateways;
use Job;
use DB;

class JobsGateway {
	public function create($input){
		$job = new Job;
		$job->fill($input);
		$job->save();
	}
	public function apply($student,$job){
		$result = DB::table('job_user')
			->where('user_id', $student)
			->where('job_id', $job)
			->get();
		if (empty($result)) {
			DB::table('job_user')->insert(
   				 array(
   				 	'user_id' => $student, 
   				 	'job_id' => $job,
   				 	'type' =>0 //0>applied
   				 	)
			);
			return "წარმატებით გააკეთეთ შეთავაზება";
		}else{
			return "თქვენ ერთხელ უკვე გააგზავნეთ შეთავაზება ამ პროექტზე";
		}
	}
}