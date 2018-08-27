<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'AuthController@loginView');

Route::get('/task/create', 'TaskController@create');

Route::post('/task/delete', 'TaskController@delete');

Route::resource('/tasks', 'TaskController');

Route::get('/register', 'AuthController@registerview');

Route::post('/login', 'AuthController@login');

Route::post('/account/create', 'AuthController@register');
