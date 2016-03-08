<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group([
    'middleware' => ['api']
], function() {
    Route::options('', ['as' => 'options', 'uses' => 'UserController@options']);
    Route::get('{id}', ['as' => 'read', 'uses' => 'UserController@read']);
    Route::get('', ['as' => 'index', 'uses' => 'UserController@index']);
    Route::post('', ['as' => 'create', 'uses' => 'UserController@create']);
    Route::put('', ['as' => 'update', 'uses' => 'UserController@update']);
    Route::delete('', ['as' => 'delete', 'uses' => 'UserController@delete']);
});
