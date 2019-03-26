<?php

namespace App\Http\Controllers;

use App\Http\Renderers\GameRenderer;
use App\Models\User;

use Illuminate\Http\Request;

use View;

class UserController extends Controller {

    private $gameRenderer;

    public function __construct(GameRenderer $gameRenderer) {
        $this->gameRenderer = $gameRenderer;
    }

    /**
     * Checks whether or not their is a user in the system with the provided id
     */
    public function validateId(Request $request) {
        $guid = $request->input('guid');
        $user = User::where('guid', $guid)->get();
        return response()->json([
            'valid' => (count($user) === 1)
        ]);
    }

    /**
     * Creates a user with the provided name in the system. Returns the player lobby view following
     * this change along with the new user's guid so that the identity can be set on the front-end
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
     * Returns whatever the user should be looking at following a visit to the site root
     */
    public function refreshPage(Request $request) {
        $guid = $request->input('guid');

        $user = User::where('guid', $guid)->first();

        if (null === $user) {
            return response()->json([
                'view' => view('player.name')->render(),
                'action' => 'unsetGuid'
            ]);
        }

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
     * Returns the main player lobby if the user of the site already has an identity established on
     * the front-end
     */
    public function playerLobby(Request $request) {
        $view = view('player.lobby')->with('name', $request->user->name)->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

}