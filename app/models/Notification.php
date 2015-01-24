<?php

use Watson\Validating\ValidatingTrait;

class Notification extends Eloquent {
	use ValidatingTrait;

	protected $table = 'notifications';
	protected $fillable = ['to_user','project_id'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'to_user'   => 'required',
        'project_id'  => 'required'
    ];
}
