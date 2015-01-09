<?php

class Integration extends \Eloquent {
	protected $fillable = ['service','username'];
	
	public function users()
    {
        return $this->belongsTo('User');
    }
}