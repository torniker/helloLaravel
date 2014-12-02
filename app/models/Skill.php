<?php

class Skill extends Eloquent{	
	protected $fillable = [];
	public function users()
    {
        return $this->belongsToMany('User')->withPivot('level');
    }
}
?>
