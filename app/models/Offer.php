<?php

class Offer extends \Eloquent {
	protected $fillable = ['message','price','currency','project_id','user_id','status','feedback'];
    
    public $rules = [
        'creating' => [
            'message' => 'required',
            'price' => 'required|numeric|min:0.01',
            'currency' => 'required|min:1|max:3',
            'project_id' => 'required|exists:projects,id'
        ],
        'hiring' => [
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'offer_id' => 'required|exists:offers,id'
        ],
        'finishing' => [
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'offer_id' => 'required|exists:offers,id'
        ],
        'adding_feedback' => [
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'offer_id' => 'required|exists:offers,id',
            'feedback' => 'required' 
        ]
    ];

	public function project(){
        return $this->belongsTo('Project'); 
    }

    public function user(){
        return $this->belongsTo('User'); 
    }
    
    public function currencyText(){
    	switch ($this->attributes['currency']) {
    		case '1':
    			return 'USD';
    			break;
    		case '2':
    			return 'GEL';
    			break;

    		case '3':
    			return 'EURO';
    			break;
    	}

    	return 'NO_CURRENCY';
    }

    public function isHired(){
        if($this->status>=2){
            return true;
        }

        return false;
    }
}