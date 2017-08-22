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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/contacts','ContactController@index');

Route::get('/contacts/create','ContactController@create');

Route::get('/contacts/{id}/edit','ContactController@edit');

Route::post('/contacts/store','ContactController@store');

Route::post('/contacts/{id}/update','ContactController@update');

Route::get('/contacts/delete/{id}','ContactController@destroy');

