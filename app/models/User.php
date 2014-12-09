	<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait, SoftDeletingTrait, ValidatingTrait;


	protected $table = 'users';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = ['firstname', 'lastname', 'email','gender'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'username'   => 'required',
        'firstname'  => 'required',
        'lastname'   => 'required'
    ];

	

	public function phones()
	{
		return $this->hasMany('Phone');
	}

	public function skills()
	{
		return $this->belongsToMany('Skill');
	}

	public function getGender() {
		if($this->attributes['gender']) {
			return 'male';
		}
		return 'female';
	}


}
