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

Route::get('/', 'LoginController@index');

Route::get('/register', 'RegisterController@index');

Route::resource('tasks','TaskController');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('tasks/{id}/invite', array('as'=>'tasks/invite', 'uses'=>'TaskController@invite'));

Route::post('tasks/{id}/invite/create', array('as'=>'tasks/invite/create', 'uses'=>'TaskController@inviteCreate'));
// Route::get('tasks/{id}/invite', function ($id) {
//     return 'task/invite';
// });
// Route::get('task/invite', 'TaskController@bainvite');

