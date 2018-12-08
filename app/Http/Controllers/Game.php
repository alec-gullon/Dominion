<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game\State;
use App\Models\Game as GameModel;

use App\Services\CardBuilder;
use App\Services\Updater;

class Game extends Controller {

    private $state;

    private $cardBuilder;

    public function __construct(State $state, CardBuilder $cardBuilder) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
    }

    /**
     * Creates a game and associates the provided user to it. Then when another player visits the provided link,
     * they will be prompted to choose an identity and will be associated to the game as well.
     */
    public function create(Request $request) {
        $user = $request->input('user');
        $game = new GameModel();

        $state = new State();

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        $view = view('player.waiting-room', [
            'name' => $user->name,
            'gameId' => $game->guid
        ])->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    /**
     * Creates a Game Updater and attempts to update the given game using the input that the user provided
     */
    public function update(Request $request) {
        $user = $request->input('user');
        $game = $user->game;

        $updater = new Updater(unserialize($game->object), $this->cardBuilder);

        $updater->update($request->input('action'), $request->input('input'));
        $updater->resolve();

        $game->object = serialize($updater->getState());
        $game->save();

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
                    'view' => $view,
                    'action' => 'refreshView'
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