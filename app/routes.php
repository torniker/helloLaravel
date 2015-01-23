<?php

Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');

Route::group(['prefix' => 'admin'], function()
{
	Route::resource('user', 'UserController');
	Route::resource('skill', 'SkillController');
	Route::get('generator', array('uses' => 'LinkController@index'));
	Route::post('generate', array('uses' => 'LinkController@generate'));
	Route::get('trainings', array('uses' => 'TrainingController@index'));
	Route::get('trainings/create', array('uses' => 'TrainingController@create'));
	Route::get('trainings/edit', array('uses' => 'TrainingController@edit'));
	Route::get('trainings/edit/{id}', array('uses' => 'TrainingController@edit'));
	Route::post('trainings/store', array('uses' => 'TrainingController@store'));
	Route::post('trainings/update', array('uses' => 'TrainingController@update'));
	Route::post('trainings/update/{id}', array('uses' => 'TrainingController@update'));
	Route::post('trainings/delete', array('uses' => 'TrainingController@destroy'));
	Route::post('trainings/delete/{id}', array('uses' => 'TrainingController@destroy'));
});


// როუტი ლოგინის ფორმისთვის
Route::get('login', array('uses' => 'LoginController@showLogin'));
Route::get('newstudent', array('uses' => 'UserFrontendController@stud_register'));

// როუტი ლოგინის პროცესინგისთვის
Route::post('login', array('uses' => 'LoginController@doLogin'));

// როუტი ლოგაუთის პროცესინგისთვის
Route::get('logout', array('uses' => 'LoginController@logOut'));

// როუტი დაშბორდისთვის
Route::get('dashboard', array('uses' => 'LoginController@dashBoard'));

Route::get('editprofile', array('uses' => 'HomeController@editProfile'));
Route::get('editprofile/{user}', array('uses' => 'HomeController@editProfile'));

Route::post('doedit', array('uses' => 'UserFrontendController@doEdit'));

Route::get('register', array('uses' => 'UserFrontendController@register'));
Route::post('doregister', array('uses' => 'UserFrontendController@doRegister'));

Route::get('github', array('uses' => 'LoginController@github'));

Route::get('clientprofile', array('uses' => 'ClientController@dashboard'));

Route::any('form-submit', function(){
 var_dump(Input::file('file')->getClientOriginalName());
});

Route::get('show', array('uses' => 'UserFrontendController@show'));
Route::get('show/{id}', array('uses' => 'UserFrontendController@show'));

Route::group(['prefix' => 'jobs'], function()
{
	Route::get('/', array('uses' => 'JobsController@index'));
	Route::get('index', array('uses' => 'JobsController@index'));
	Route::get('add', array('uses' => 'JobsController@add'));
	Route::post('create', array('uses' => 'JobsController@create'));
	Route::get('show', array('uses' => 'JobsController@show'));
	Route::get('show/{id}', array('uses' => 'JobsController@show'));
	Route::post('apply', array('uses' => 'JobsController@apply'));
});