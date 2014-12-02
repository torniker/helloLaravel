<?php

class UsersController extends BaseController {

	public function index()
	{	
		if (Request::ajax()) 
		{
			$skills = Input::get('skills',array()); 
			$skills = array_filter($skills);
			if($skills===false){
				Response::make('',400);
			}
			$users = array();

			$userIds = array(); 

			foreach ($skills as $key => $skill) {
				$skillData = Skill::with('users')->where('name',$skill)->get()->first();

				if(!$skillData){
					$userIds = false;
					break;
				}

				$tmpIds = array();

				foreach ($skillData->users as $key => $data) {
					$tmpIds[] = $data->id;
				}

				if(count($userIds)===0){
					$userIds = $tmpIds;
				} else {
					foreach ($userIds as $idkey => $id) {
						if(!in_array($id, $tmpIds)){
							unset($userIds[$idkey]);
						}
					}
				}

			} 

			if(!$userIds && count($skills)>0){
				return Response::json(array()); 
			}

			$users = User::with('skills');
			if(count($userIds)>0){
				$users =$users->whereIn('id',$userIds); 
			}
			$users = $users->get()->toArray(); 


			return Response::json($users); 
		}
		
		$users = User::with('skills')->get();
		debug($users[0]);
		return View::make('home.index')->with('users', $users);
	}

}
