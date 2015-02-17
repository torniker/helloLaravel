<?php

class Comment extends \Eloquent {
	protected $fillable = ['user_id','project_id','message'];

    public $rules = [
        'creating' => [
            'user_id' => 'required',
            'project_id' => 'required|exists:projects,id',
            'message' => 'required'
        ]
    ];

	public function project(){
        return $this->belongsTo('Project'); 
    }

    public function user(){
    	return $this->belongsTo('User');
    }

    public function user_type_class(){
    	if($this->user->type==2){
    		return 'staff';
    	} else {
    		return 'user';
    	}
    } 

    public function user_badge(){
    	if($this->user->type==2){
    		return "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
  		}
    }
}