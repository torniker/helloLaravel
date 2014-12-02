<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin', 'before'=>'auth.basic'], function()
{
	Route::controller('user', 'UserController');
});