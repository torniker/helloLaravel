<?php namespace pro\repositories;

use Validator;
use Auth;
use Redirect;
use User;
use Hash;
use Phone;

class UserFrontendRepository {
	public function doRegister($input, $user){
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
		return Redirect::to("/")->with('message','თქვენ წარმატებით დარეგისტრირდით, ახლა შეგიძლიათ შეხვიდეთ სისტემაში');
	}

	public function doEdit($input){
		$id = $input['id'];
		$user = User::find($id);
		$user->username=$input['username'];
		$user->firstname=$input['firstname'];
		if (!empty($input['password'])) {
			$user->password=Hash::make($input['password']);
		}
		$user->save();

		$hisphones = $input['phone'];
		foreach ($hisphones as $id => $phone) {
			$result = \Phone::find($id);
			if (!empty($result)) {
				$res_phone=$result->phone;
				if ($phone!=$res_phone) {
					$result->phone=$phone;
					$result->save();
				}
			}else{
				$newPhone = new Phone;
				$newPhone->phone=$phone;
				$newPhone->user_id=$user->id;
				$user->phones()->save($newPhone);
			}
		}

		return Redirect::to('dashboard');
	}
}
