<?php

class Project extends \Eloquent {
	protected $fillable = ['title','body','expires','user_id'];

	public function user()
    {
        return $this->belongsTo('User'); 
    }

    public function offers(){
    	return $this->hasMany('Offer');
    }
}