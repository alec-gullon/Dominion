<?php

namespace App\Http\Controllers;

use App\Http\Renderers\GameRenderer;
use App\Models\User;
use App\Models\Game;
use App\Game\Services\Setup\SetsUpTwoPlayerGame;

use Illuminate\Http\Request;

use View;

class UserController extends Controller {

    private $gameRenderer;

    public function __construct(GameRenderer $gameRenderer) {
        $this->gameRenderer = $gameRenderer;
    }

    public function validateId(Request $request) {
        $guid = $request->input('guid');
        $user = User::where('guid', $guid)->get();
        return response()->json([
            'valid' => (count($user) === 1)
        ]);
    }

    /**
     * Take the provided name and generate a user with this name and assign it to a guid. Then return this guid to the
     * front end so that the client has an identity.
     *
     * @param   mixed $request
     *
     * @return  string
     *
     * @throws \Throwable
     */
    public function setName(Request $request) {
        $user = new User();

        $user->name = $request->input('name');
        $user->guid = uniqid();
        $user->game_id = 0;
        $user->save();

        $view = view('player.lobby')->with([
            'name' => $user->name
        ])->render();

        return response()->json([
            'view' => $view,
            'action' => 'setGuid',
            'guid' => $user->guid
        ]);
    }

    /**
     * Returns what the given user should currently be looking at to be placed within the html wrapper.
     */
    public function refreshPage(Request $request) {
        $guid = $request->input('guid');

        $user = User::where('guid', $guid)->first();

        if ($user->game_id === '0') {
            return $this->gameRenderer->renderLobby($user);
        }

        $game = $user->game;
        $state = unserialize($game->object);
        if (count($state->players) <= 1) {
            return $this->gameRenderer->renderWaitingRoom($user->game, $user);
        }

        return $this->gameRenderer->renderGameForPlayer($user->game, $user);
    }

    /**
     * Returns the form to set the name if the user does not have an already established identity
     */
    public function nameForm() {
        $view = view('player.name')->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    /**
     *
     */
    public function playerLobby(Request $request) {
        $view = view('player.lobby')->with('name', $request->user->name)->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    /**
     * Joins the game
     */
    public function joinGame(SetsUpTwoPlayerGame $setsUpNewPlayers, Request $request) {
        $user = $request->user;
        $game = Game::where('guid', $request->input('gameGuid'))->first();

        $user->game_id = $game->id;
        $user->save();

        $game = $setsUpNewPlayers->setup($game);
        $game->save();

        return $this->gameRenderer->renderGameForBothPlayers($game);
    }

}