<?php

namespace App\Http\Renderers;

use App\Services\CardBuilder;
use App\Services\GameObserver;

class GameRenderer {

    public function renderGameForPlayer($game, $user) {
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

    public function renderGameForBothPlayers($game) {
        $state = unserialize($game->object);

        $responses = [];

        foreach ($game->users as $user) {
            $view = view('game.index', [
                'cardBuilder' => new CardBuilder(),
                'state' => $state,
                'gameObserver' => new GameObserver($state),
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

    public function renderWaitingRoom($game, $user) {
        $view = view('player.waiting-room', [
            'name' => $user->name,
            'gameId' => $game->guid
        ])->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

    public function renderLobby($user) {
        $view = view('player.lobby')->with(['name' => $user->name])->render();
        return response()->json([
            'view' => $view,
            'action' => 'refreshView'
        ]);
    }

}