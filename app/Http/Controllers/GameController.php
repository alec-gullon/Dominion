<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game\Services\Updater;
use App\Game\Services\Setup\SetsUpAIGame;

use App\Game\Models\State;
use App\Models\Game as GameModel;

use App\Http\Renderers\GameRenderer;

class GameController extends Controller {

    private $state;

    private $gameRenderer;

    public function __construct(State $state, GameRenderer $gameRenderer) {
        $this->state = $state;
        $this->gameRenderer = $gameRenderer;
    }

    public function create(Request $request) {
        $user = $request->input('user');
        $game = new GameModel();

        $state = resolve('\App\Game\Models\State');

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        return $this->gameRenderer->renderWaitingRoom($game, $user);
    }

    public function createAIGame(Request $request, SetsUpAIGame $setsUpAIGame) {
        $user = $request->input('user');
        $game = new GameModel();

        $state = resolve('\App\Game\Models\State');

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        $game = $setsUpAIGame->setup($game);
        $game->save();

        return $this->gameRenderer->renderGameForBothPlayers($game);
    }

    public function update(Request $request, Updater $updater) {
        $user = $request->input('user');
        $game = $user->game;

        $updater->setState(unserialize($game->object));
        $updater->update($request->input('action'), $request->input('input'));
        $updater->resolve();

        $game->object = serialize($updater->state());

        $game->save();

        return $this->gameRenderer->renderGameForPlayer($game, $user);
//        return $this->gameRenderer->renderGameForBothPlayers($game);
    }

}