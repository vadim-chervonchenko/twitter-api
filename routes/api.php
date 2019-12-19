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

/* twitter user methods */
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

/* hashtags and mentions */
Route::get('/mention', 'MentionController@index');
Route::get('/mention/{name}', 'MentionController@search');
Route::get('/hashtag', 'HashTagController@index');
Route::get('/hashtag/{name}', 'HashTagController@search');

/* filter verify jwt token */
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('tweets', 'TweetsController@index');
    Route::get('tweets/{id}', 'TweetsController@show');
    Route::put('tweets/{id}', 'TweetsController@update');
    Route::delete('tweets/{id}', 'TweetsController@delete');
    Route::post('tweets', 'TweetsController@store');

    /* user */
    Route::get('/user', 'AuthController@getAuthenticatedUser');
});
