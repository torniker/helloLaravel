<?php

class Course extends \Eloquent {
	protected $fillable = ['name','score'];
	protected $table = 'course';
	public function users()
    {
        return $this->belongsToMany('User');
    }
}