<?php

class Offer extends \Eloquent {
	protected $fillable = ['message','price','currency','project_id','user_id','hired'];
    
    public $rules = [
        'creating' => [
            'message' => 'required',
            'price' => 'required|numeric|min:0.01',
            'currency' => 'required|min:1|max:3',
            'project_id' => 'required|exists:projects,id'
        ],
        'hiring' => [
            'project_id' => 'required',
            'user_id' => 'required',
            'offer_id' => 'required|exists:project_id,user_id,id:'
        ]
    ];

	public function Project(){
        return $this->belongsTo('Project'); 
    }

    public function User(){
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
        if($this->hired==1){
            return true;
        }

        return false;
    }
}