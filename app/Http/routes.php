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


Route::resource('tasks','TaskController');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('tasks/{id}/invite', array('as'=>'tasks/invite', 'uses'=>'TaskController@invite'));

Route::post('tasks/{id}/invite/create', array('as'=>'tasks/invite/create', 'uses'=>'TaskController@inviteCreate'));

Route::post('tasks/{id}/invite/inviteDestroy', 'TaskController@inviteDestroy');

// Route::post('tasks/{id}/invite/inviteDestroy', array('as'=>'tasks/invite/inviteDestroy', 'uses'=>'TaskController@inviteDestroy'));
// Route::get('tasks/{id}/invite', function ($id) {
//     return 'task/invite';
// });
// Route::get('task/invite', 'TaskController@bainvite');

Route::get('/task/create', 'TaskController@create');

Route::post('/task/delete', 'TaskController@delete');

Route::get('/register', 'AuthController@registerview');

Route::post('/login', 'AuthController@login');

Route::post('/account/create', 'AuthController@register');
