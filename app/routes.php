<?php


Route::group(['prefix' => 'admin','before'=>'auth|isAdmin'], function()
{
	Route::resource('/','AdminUserController');
	Route::resource('user', 'AdminUserController');
	Route::resource('skill', 'AdminSkillController');
	Route::resource('course','AdminCoursesController');
});

Route::group(['prefix'=>'freelancer','before'=>'auth'],function(){

	Route::get('/',function(){
		return Redirect::to('freelancer/projects');
	});
	Route::put('profile','FreelancerProfileController@update');

	Route::get('{id}','FreelancerProfileController@show')->where('id', '[0-9]+');;
	Route::get('projects/my','FreelancerProjectsController@myprojects');
	Route::get('projects/my/{id}','FreelancerProjectsController@myproject');

	Route::any('profile/github/add','FreelancerProfileController@linkGithub');
	Route::any('profile/github/remove','FreelancerProfileController@removeGithub');

	Route::resource('projects','FreelancerProjectsController');
	Route::resource('offers','FreelancerOffersController');
	Route::resource('profile','FreelancerProfileController');
});

Route::get('/', 'HomeController@index');
Route::controller('/', 'AuthController');