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

// Authentication routes...
use Illuminate\Support\Facades\Auth;

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'LinkController@index');

Route::resource('api/links', 'LinkController', ['middleware' => 'auth']);

Route::resource('api/tags', 'TagController',
                ['only' => ['index']]);

Route::resource('api/tags', 'TagController',
                [
                    'only' => ['store'],
                    'middleware' => 'auth'
                ]);
