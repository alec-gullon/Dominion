<?php

namespace App\Services;

use App\Services\CardBuilder;
use App\Services\GameObserver;

class GameRenderer {

    public function render($game) {
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

}