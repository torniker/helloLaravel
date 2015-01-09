<?php


Route::group(['prefix' => 'admin'], function()
{
	Route::resource('/','UserController');
	Route::resource('user', 'UserController');
	Route::resource('skill', 'SkillController');
});


Route::get('/', 'HomeController@index');
Route::controller('/', 'AuthController');