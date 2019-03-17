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

Route::get('/', 'HomeController@index')->name('home');

Route::post('/user/refresh-page/', 'UserController@refreshPage')->name('user-get-current-view');
Route::post('/user/validate-id/', 'UserController@validateId')->name('user-validate-id');
Route::post('/user/set-name/', 'UserController@setName')->name('user-set-name');
Route::post('/user/get-name-form/', 'UserController@getNameForm')->name('user-input-name-form');
Route::post('/user/join-game/', 'UserController@joinGame')->name('user-join-game')->middleware('player');

Route::post('/game/create/', 'GameController@create')->name('game-create')->middleware('player');
Route::post('/game/create-ai-game/', 'GameController@createAIGame')->name('game-create-ai-game')->middleware('player');
Route::post('/game/update/', 'GameController@update')->name('game-update')->middleware('player');

Route::get('/public/game/join/{guid}/', 'HomeController@join')->name('public-game-join');

Route::get('/concept/', 'HomeController@concept');

Route::get('/digital-pattern-library/', 'DevController@viewDigitalPatternLibrary');

Route::get('/pommel', 'DevController@pommel');
