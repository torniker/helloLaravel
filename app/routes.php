<?php


Route::group(['prefix' => 'admin','before'=>'auth|isAdmin'], function()
{
	Route::resource('/','AdminUserController');
	Route::resource('user', 'AdminUserController');
	Route::resource('skill', 'AdminSkillController');
	Route::resource('course','AdminCoursesController');
});

Route::group(['prefix'=>'freelancer','before'=>'auth'],function(){
	Route::get('/projects/my','FreelancerProjectsController@myprojects'); 
	Route::resource('/projects','FreelancerProjectsController');
	Route::resource('/offers','FreelancerOffersController');
});

Route::get('/', 'HomeController@index'); 
Route::controller('/', 'AuthController');