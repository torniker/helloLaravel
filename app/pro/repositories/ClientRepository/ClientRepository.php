<?php namespace pro\repositories\ClientRepository;

use Validator;
use Auth;
use Redirect;
use User;
use Hash;
use Phone;

class ClientRepository {
	public function doRegister($input){
		$user = new User;
	    if ($input['type']==3) {
	    	$rule=array(
	    		'company_name'=>'required',
	    		'identification_code'=>'required'
	    		);
	    	$user->addRule($rule);
	    }
		$user->fill($input);
		if (!empty($input['password'])) {
			$user->password = Hash::make($input['password']);
		}
		$user->save();
		if (!empty($input['phone'])) {
			$phones = $input['phone'];
			foreach ($phones as $ph) {
				$newPhone = new Phone;
				$newPhone->phone=$ph;
				$newPhone->user_id=$user->id;
				$user->phones()->save($newPhone);
			}
		}
		return $user;
	}
}
