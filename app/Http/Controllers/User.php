<?php

namespace App\Http\Controllers;

use App\Models\User as ModelUser;
use App\Models\Game;
use App\Models\Game\Player;
use App\Services\CardBuilder;

use Illuminate\Http\Request;

use View;

class User extends Controller {

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

        $view = view('player.lobby')->with(['name' => $user->name])->render();
        return response()->json([
            'view' => $view,
            'guid' => $guid
        ]);
    }

    /**
     * Returns what the given user should currently be looking at to be placed within the html wrapper.
     */
    public function refreshPage(Request $request) {
        $guid = $request->input('guid');

        $user = ModelUser::where('guid', $guid)->first();

        if ($user->game_id === '0') {
            $view = view('player.lobby')->with(['name' => $user->name])->render();
            return response()->json(['view' => $view]);
        }

        $game = $user->game;
        if (count($game->users) === 1) {
            $view = view('player.waiting-room', [
                'name' => $user->name,
                'gameId' => $game->guid
            ])->render();
            return response()->json(['view' => $view]);
        }

        $state = unserialize($game->object);

        $view = view('game.index', [
            'cardBuilder' => new \App\Services\CardBuilder(),
            'state' => $state,
            'gameObserver' => new \App\Services\GameObserver($state),
            'playerKey' => $user->guid
        ])->render();

        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    /**
     * Returns the form to set the name if the user does not have an already established identity
     */
    public function getNameForm() {
        $view = view('player.name')->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Joins the game
     */
    public function joinGame(Request $request) {
        $user = $request->user;
        $game = Game::where('guid', $request->input('gameHash'))->first();

        $user->game_id = $game->id;
        $user->save();

        $state = unserialize($game->object);

        $players = $game->users;

        $player1 = new Player($players[0]->guid, new CardBuilder());
        $player1->buildDefaultDeck();
        $player2 = new Player($players[1]->guid, new CardBuilder());
        $player2->buildDefaultDeck();

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerKey($player1->getId());

        $game->object = serialize($state);
        $game->save();

        $game = Game::first();
        $state = unserialize($game->object);

        $responses = [];

        foreach ($game->users as $user) {
            $view = view('game.index', [
                'cardBuilder' => new \App\Services\CardBuilder(),
                'state' => $state,
                'gameObserver' => new \App\Services\GameObserver($state),
                'playerKey' => $user->guid
            ])->render();

            $responses[] = [
                'response' => [
                    'view' => $view
                ],
                'guid' => $user->guid
            ];
        }

        return response()->json([
            'joinedGame' => true,
            'distributedResponse' => true,
            'responses' => $responses
        ]);
    }

}