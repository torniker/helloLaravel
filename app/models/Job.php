<?php

use Watson\Validating\ValidatingTrait;

class Job extends Eloquent {
	use ValidatingTrait;

	protected $table = 'jobs';
	protected $fillable = ['heading','content', 'price','author'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'heading'   => 'required',
        'content'  => 'required',
        'price'   => 'required'
    ];

    public function users(){
        return $this->belongsToMany('User');
    }
}
