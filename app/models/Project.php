<?php

class Project extends \Eloquent {
	protected $fillable = ['title','body','expires','user_id'];
    
    public $rules = [
        'creating' => [
            'title' => 'required',
            'body' => 'required',
            'expires' => 'required|date'
        ]
    ];

	public function user()
    {
        return $this->belongsTo('User'); 
    }

    public function offers(){
        return $this->hasMany('Offer');
    }

    public function comments(){
        return $this->hasMany('Comment');
    }

    public function isExpired(){
    	if($this->expires<=date('Y-m-d H:i:s')){
    		return true;
    	}

    	return false;
    }

    public function isNew(){
    	if($this->created_at>=date('Y-m-d H:i:s',time()-25)){ 
    		return true;
    	}

    	return false;
    }

    public function getDates() {
        return ['created_at','updated_at','expires'];
    }
}