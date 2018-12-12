<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game\State;
use App\Models\Game as GameModel;

use App\Services\CardBuilder;
use App\Http\Renderers\GameRenderer;
use App\Http\Renderers\WaitingRoomRenderer;
use App\Services\Updater;

use View;

class Game extends Controller {

    private $state;

    private $cardBuilder;

    private $gameRenderer;

    public function __construct(State $state, CardBuilder $cardBuilder, GameRenderer $gameRenderer) {
        $this->state = $state;
        $this->cardBuilder = $cardBuilder;
        $this->gameRenderer = $gameRenderer;
    }

    public function create(Request $request) {
        $user = $request->input('user');
        $game = new GameModel();

        $game->object = serialize(new State());
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        return $this->gameRenderer->renderWaitingRoom($user, $game);
    }

    public function update(Request $request) {
        $user = $request->input('user');
        $game = $user->game;

        $updater = new Updater(unserialize($game->object), $this->cardBuilder);
        $updater->update($request->input('action'), $request->input('input'));
        $updater->resolve();

        $game->object = serialize($updater->getState());

        $game->save();

        return $this->gameRenderer->renderGame($game);
    }

}