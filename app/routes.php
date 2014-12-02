<?php


Route::get('home', 'HomeController@index');
Route::post('filter', 'HomeController@filterSkills');
Route::get('tag/{name}', 'HomeController@byTag');
