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
	Route::post('user/store/', array('uses' => 'UserController@store'));
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
Route::post('storestud', array('uses' => 'UserFrontendController@store'));


Route::get('gitauth', array('uses' => 'LoginController@gitAuth'));
Route::get('gitlogin', array('uses' => 'LoginController@gitLogin'));



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
	Route::post('choose', array('uses' => 'JobsController@choose'));
	Route::post('close', array('uses' => 'JobsController@close'));
	Route::post('failure/{id}', array('uses' => 'JobsController@failure'));
	Route::post('success/{id}', array('uses' => 'JobsController@success'));
	Route::get('like/{id}', array('uses' => 'JobsController@like'));
});

Route::get('my-projects', array('uses' => 'JobsController@myAll'));
Route::get('my-completed', array('uses' => 'JobsController@myCompleted'));
Route::get('my-ongoing', array('uses' => 'JobsController@myOngoing'));
Route::get('my-failed', array('uses' => 'JobsController@myFailed'));

Route::post('comments/add', array('uses' => 'CommentController@add'));
Route::post('comments/delete', array('uses' => 'CommentController@delete'));
Route::post('comments/delete/{id}', array('uses' => 'CommentController@delete'));

Route::get('filter', array('uses' => 'UserFrontendController@filter'));
Route::get('filter/{id}', array('uses' => 'UserFrontendController@filter'));