<?php

class Phone extends \Eloquent {
	protected $fillable = ['phone,user_id'];

	public function user()
    {
        return $this->belongsTo('User');
    }
}