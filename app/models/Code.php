<?php

class Code extends Eloquent {
	protected $table = 'codes';
	protected $fillable = ['code','valid'];
	protected $throwValidationExceptions = true;
	protected $rules = [
        'code'   => 'required'
    ];
}
