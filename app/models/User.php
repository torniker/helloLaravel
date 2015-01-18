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
	protected $fillable = ['username','firstname', 'lastname', 'email','gender','company_name','identification_code','type'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'username'   => 'required',
        'firstname'  => 'required',
        'lastname'   => 'required',
        'email'   => 'required',
        'password'   => 'required'
    ];

	public function phones()
	{
		return $this->hasMany('Phone');
	}

	public function skills()
	{
		return $this->belongsToMany('Skill')->withPivot('level');
	}

	public function jobs()
	{
		return $this->belongsToMany('Job')->withPivot('type');
	}

	public function trainings()
	{
		return $this->belongsToMany('Training');
	}

	public function getGender() {
		if($this->attributes['gender']) {
			return 'male';
		}
		return 'female';
	}

	public function addRule($rule){
		$this->rules = array_merge($this->rules,$rule);
	}

	public static function pr($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}

}
