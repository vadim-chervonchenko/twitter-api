<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('tweets', 'TweetsController@index');
Route::get('tweets/{id}', 'TweetsController@show');
Route::put('tweets/{id}', 'TweetsController@update');
Route::delete('tweets/{id}', 'TweetsController@delete');
Route::post('tweets', 'TweetsController@store');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');