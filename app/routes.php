<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin'], function()
{
	Route::resource('user', 'UserController');
	Route::resource('skill', 'SkillController');
});




// როუტი ლოგინის ფორმისთვის
Route::get('login', array('uses' => 'LoginController@showLogin'));

// როუტი ლოგინის პროცესინგისთვის
Route::post('login', array('uses' => 'LoginController@doLogin'));

// როუტი ლოგაუთის პროცესინგისთვის
Route::get('logout', array('uses' => 'LoginController@logOut'));

// როუტი დაშბორდისთვის
Route::get('dashboard', array('uses' => 'LoginController@dashBoard'));

Route::get('editprofile', array('uses' => 'HomeController@editProfile'));

Route::post('doedit', array('uses' => 'HomeController@doEdit'));

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin', 'before'=>'auth.basic'], function()
{
	Route::controller('user', 'UserController');
});