<?php

use Watson\Validating\ValidatingTrait;

class Comment extends Eloquent {
	use ValidatingTrait;

	protected $table = 'comments';
	protected $fillable = ['text','user_id','job_id'];
	protected $throwValidationExceptions = true;
	

    public function user(){
        return $this->belongsTo('User');
    }

    public function job(){
        return $this->belongsTo('Job');
    }
}
