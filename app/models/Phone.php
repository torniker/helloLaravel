<?php

class Phone extends \Eloquent {
	protected $fillable = [];


	public function user()
    {
        return $this->belongsTo('User');
    }
}