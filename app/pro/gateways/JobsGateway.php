<?php namespace pro\gateways;
use Job;
use DB;
use User;

class JobsGateway {
	public function create($input){
		$job = new Job;
		$job->fill($input);
		$job->save();
		return $job->id;
	}
	public function apply($student,$job,$bid){
		$result = DB::table('job_user')
			->where('user_id', $student)
			->where('job_id', $job)
			->get();
		if (empty($result)) {
			DB::table('job_user')->insert(
   				 array(
   				 	'user_id' => $student, 
   				 	'job_id' => $job,
   				 	'price' => $bid,
   				 	'type' =>1 //bid pending
   				 	)
			);
			return "წარმატებით გააკეთეთ შეთავაზება";
		}else{
			return "თქვენ ერთხელ უკვე გააგზავნეთ შეთავაზება ამ პროექტზე";
		}
	}
	public function choose($input){
		$job = $input['job'];
		$student = $input['user'];
		$user = User::find($student);
		try{
			$user->jobs()->attach($job, array('type' => 2));
			return 'პროგრამისტი წარმატებით იქნა არჩეული!';
		}catch (\Exception $e) {
    		return 'ეს პროგრამისტი უკვე აირჩიე';
		}
	}
}