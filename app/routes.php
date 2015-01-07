<?php

Route::get('/', 'HomeController@index');
Route::controller('/', 'AuthController');

Route::group(['prefix' => 'admin', 'before'=>'auth.basic'], function()
{
	Route::resource('/','UserController');
	Route::resource('user', 'UserController');
	Route::resource('skill', 'SkillController');
});