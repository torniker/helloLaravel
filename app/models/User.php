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
	protected $fillable = ['firstname', 'lastname', 'email','gender','github_token'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'username'   => 'required',
        'firstname'  => 'required',
        'lastname'   => 'required'
    ];

	public function integrations()
	{
		return $this->hasMany('Integration');
	}

	public function phones()
	{
		return $this->hasMany('Phone');
	}

	public function skills()
	{
		return $this->belongsToMany('Skill');
	}

	public function courses()
	{
		return $this->belongsToMany('Course','course_user')->withPivot('score');
	}

	public function offers(){
		return $this->hasMany('Offer');
	}

	public function projects(){
		return $this->hasMany('Project');
	}

	public function getGenderText() {
		if($this->attributes['gender']==1) {
			return 'Male';
		}
		return 'Female';
	}

	public function isAdmin(){
		if($this->type==2){
			return true;
		}

		return false;
	}

	public function isFreelancer(){
	if($this->type==1){
			return true;
		}

		return false;
	}

}
