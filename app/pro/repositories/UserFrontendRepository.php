<?php namespace pro\repositories;

use Validator;
use Auth;
use Redirect;
use User;
use Hash;
use Phone;
use DB;

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
		$this->update_phones($hisphones,$user,$id);
		return Redirect::to('dashboard');
	}



	private function update_phones($hisphones,$user,$userid){
		foreach ($hisphones as $id => $phone) {
			if (!empty($phone)) {
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
		}

		$allPhones=Phone::get();
		foreach ($allPhones as $basephone) {
			if (!in_array($basephone->phone, $hisphones)) {
				$result = DB::table('phones')
				->where('user_id', $userid)
				->where('phone', $basephone->phone)
				->get();
				if (!empty($result)) {
					DB::table('phones')
					->where('user_id', '=', $userid)
					->where('phone', '=', $basephone->phone)
					->delete();
				}
			}
		}
	}

	public function create($input) {
		//file_put_contents('./text.txt', $input['type']);
		$user = new User;
		$trainings = $input['trainings'];
		$trlevels=$input['trlevel'];

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
		$user=$user->find($user->id);
		$user->trainings()->attach($trainings);

		foreach ($trainings as $training) {
			$result = DB::table('training_user')
			->where('user_id', $user->id)
			->where('training_id', $training)
			->get();

			$trlevel = !empty($trlevels[$training])?$trlevels[$training]:0;

			if (empty($result)) {
				DB::table('training_user')->insert(
					array(
						'user_id' 	=> $user->id, 
						'training_id' 	=> $training,
						'level' 	=> $trlevel,
						)
					);
			}elseif($result[0]->level!=$trlevel){
				DB::table('training_user')
				->where('user_id', $user->id)
				->where('training_id', $training)
				->update(array('level' => $trlevel));
			}
		}

		return 1;
	}
}
