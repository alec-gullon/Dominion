<?php

namespace App\Http\Controllers;

use App\Http\Renderers\GameRenderer;
use App\Models\User as ModelUser;
use App\Models\Game;
use App\Models\Game\Player;
use App\Services\CardBuilder;
use App\Services\Game\SetsUpNewPlayers;

use Illuminate\Http\Request;

use View;

class User extends Controller {

    private $gameRenderer;

    public function __construct(GameRenderer $gameRenderer) {
        $this->gameRenderer = $gameRenderer;
    }

    /**
     * Take the given id and check that a user corresponding to that guid exists in the database.
     */
    public function validateId(Request $request) {
        $guid = $request->input('guid');
        $user = ModelUser::where('guid', $guid);
        $userExists = (count($user) === 0);
        return response()->json(['userExists' => $userExists]);
    }

    /**
     * Take the provided name and generate a user with this name and assign it to a guid. Then return this guid to the
     * front end so that the client has an identity.
     */
    public function setName(Request $request) {
        $user = new ModelUser();
        $guid = uniqid();

        $user->name = $request->input('name');
        $user->guid = $guid;
        $user->game_id = 0;
        $user->save();

        return $this->gameRenderer->renderLobby($user);
    }

    /**
     * Returns what the given user should currently be looking at to be placed within the html wrapper.
     */
    public function refreshPage(Request $request) {
        $guid = $request->input('guid');

        $user = ModelUser::where('guid', $guid)->first();

        if ($user->game_id === '0') {
            return $this->gameRenderer->renderLobby($user);
        }

        $game = $user->game;
        if (count($game->users) === 1) {
            return $this->gameRenderer->renderWaitingRoom($game, $user);
        }

        return $this->gameRenderer->renderGameForPlayer($game, $user);
    }

    /**
     * Returns the form to set the name if the user does not have an already established identity
     */
    public function getNameForm() {
        $view = view('player.name')->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    /**
     * Joins the game
     */
    public function joinGame(SetsUpNewPlayers $setsUpNewPlayers, Request $request) {
        $user = $request->user;
        $game = Game::where('guid', $request->input('gameHash'))->first();

        $user->game_id = $game->id;
        $user->save();

        $game = $setsUpNewPlayers->setup($game);
        $game->save();

        return $this->gameRenderer->renderGameForBothPlayers($game);
    }

}