<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\DevController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/',                             [HomeController::class, 'index'])->name('home');
Route::get('/game/new/',                    [HomeController::class, 'index'])->name('newGame');

Route::get('/game/join/{guid}/',            [GameController::class, 'joinForm'])->name('homeJoin');

Route::get('/digital-pattern-library/',     [DevController::class, 'digitalPatternLibrary'])->name('devDigitalPatternLibrary');

Route::get('/about/',                       [HomeController::class, 'about'])->name('about');

/**
 * AJAX routes. Routes that perform operations on the back-end. Return json responses
 */
Route::post('/user/validate-id/',           [UserController::class, 'validateId'])->name('userValidateId');
Route::post('/user/refresh-page/',          [UserController::class, 'refreshPage'])->name('userGetCurrentView');
Route::post('/user/name-form/',             [UserController::class, 'nameForm'])->name('userInputNameForm');
Route::post('/user/set-name/',              [UserController::class, 'setName'])->name('userSetName');
Route::post('/user/player-lobby/',          [UserController::class, 'playerLobby'])->name('userGetPlayerLobby')->middleware('player');

Route::post('/game/create/',                [GameController::class, 'create'])->name('gameCreate')->middleware('player');
Route::post('/game/create/ai/',             [GameController::class, 'createAIGame'])->name('gameCreateAiGame')->middleware('player');
Route::post('/game/join/',                  [GameController::class, 'join'])->name('userJoinGame')->middleware('player');
Route::post('/game/update/',                [GameController::class, 'update'])->name('gameUpdate')->middleware('player');
