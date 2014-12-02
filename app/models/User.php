<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function phones(){
		return $this->hasMany('Phone');
	}
	
	public function skills()
    {
        return $this->belongsToMany('Skill')->withPivot('level');
    }

    public function getGenderAttribute(){
    	if ($this->attributes['gender']) {
    		return 'male';
    	}
    	return 'female';
    }

}
