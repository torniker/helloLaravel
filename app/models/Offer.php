<?php

class Offer extends \Eloquent {
	protected $fillable = ['price','currency','project_id'];

	public function Project(){
        return $this->belongsTo('Project'); 
    }
}