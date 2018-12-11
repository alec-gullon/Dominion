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

Route::get('/', 'Home@index')->name('home');

Route::post('/user/refresh-page/', 'User@refreshPage')->name('user-get-current-view');
Route::post('/user/validate-id/', 'User@validateId')->name('user-validate-id');
Route::post('/user/set-name/', 'User@setName')->name('user-set-name');
Route::post('/user/get-name-form/', 'User@getNameForm')->name('user-input-name-form');
Route::post('/user/join-game/', 'User@joinGame')->name('user-join-game')->middleware('player');

Route::post('/game/create/', 'Game@create')->name('game-create')->middleware('player');
Route::post('/game/update/', 'Game@update')->name('game-update')->middleware('player');

Route::get('/stub/', 'Home@stub');

Route::get('/public/game/join/{guid}/', 'Home@join')->name('public-game-join');
