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
}
