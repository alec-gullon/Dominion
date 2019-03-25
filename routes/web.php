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

/**
 * Landing routes. These routes tend to do either of the following:
 *      - deliver an HTML shell, the contents of which are properly populated dependent on the front-end state
 *      - deliver a fully fledged HTML page, for the simpler pages whose content is independent of front-end state
 */

Route::get('/',                             'HomeController@index')->name('home');
Route::get('/game/new/',                    'HomeController@index')->name('newGame');

Route::get('/game/join/{guid}/',            'GameController@joinForm')->name('homeJoin');

Route::get('/digital-pattern-library/',     'DevController@digitalPatternLibrary')->name('devDigitalPatternLibrary');

/**
 * AJAX routes. Routes that perform operations on the back-end. Return json responses
 */
Route::post('/user/validate-id/',           'UserController@validateId')->name('userValidateId');
Route::post('/user/refresh-page/',          'UserController@refreshPage')->name('userGetCurrentView');
Route::post('/user/name-form/',             'UserController@nameForm')->name('userInputNameForm');
Route::post('/user/set-name/',              'UserController@setName')->name('userSetName');
Route::post('/user/player-lobby/',          'UserController@playerLobby')->name('userGetPlayerLobby')->middleware('player');

Route::post('/game/create/',                'GameController@create')->name('gameCreate')->middleware('player');
Route::post('/game/create/ai/',             'GameController@createAIGame')->name('gameCreateAiGame')->middleware('player');
Route::post('/game/join/',                  'GameController@join')->name('userJoinGame')->middleware('player');
Route::post('/game/update/',                'GameController@update')->name('gameUpdate')->middleware('player');
