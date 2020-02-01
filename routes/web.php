<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@show');

Route::post('/createTweet', 'ProfileController@createTweet');

Route::post('/deleteTweet', 'ProfileController@deleteTweet');

Route::post('/tweet', 'ProfileController@editTweet');
Route::get('/tweet', 'ProfileController@showEditTweet');

Route::any('userList', 'UsersController@show');

