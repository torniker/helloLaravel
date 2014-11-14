<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/', function()
{
	return View::make('hello');
});

Route::any('about', function(){
	return 'about page';
});

Route::get('user', array('before' => 'old', function()
{
    return 'You are over 200 years old!';
}));
