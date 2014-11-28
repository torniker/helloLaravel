<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');

	public function phones()
	{
		return $this->hasMany('Phone');
	}

	public function skills()
	{
		return $this->belongsToMany('Skill');
	}

	public function getGenderAttribute() {
		if($this->attributes['gender']) {
			return 'male';
		}
		return 'female';
	}


}
