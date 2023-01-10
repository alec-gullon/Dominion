<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game\Helpers\StringHelper;
use App\Game\Services\Updater;
use App\Game\Services\Setup\SetsUpAIGame;
use App\Game\Services\Setup\SetsUpTwoPlayerGame;
use App\Http\Renderers\GameRenderer;
use App\Models\Game;

class GameController extends Controller {

    private $gameRenderer;

    public function __construct(GameRenderer $gameRenderer) {
        $this->gameRenderer = $gameRenderer;
    }

    /**
     * Creates a two player game, attaches the requesting user to it and returns a shareable link that can
     * be used to get another player involved
     */
    public function create(Request $request) {
        $user = $request->input('user');
        $game = new Game();

        $state = resolve('\App\Game\Models\State');
        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        return $this->gameRenderer->renderWaitingRoom($game, $user);
    }

    /**
     * Creates a game for the requesting user with an AI opponent and then returns a rendering of the gameboard
     * for the player to take their first turn
     */
    public function createAIGame(Request $request, SetsUpAIGame $setsUpAIGame) {
        $user = $request->input('user');
        $game = new Game();

        $state = resolve('\App\Game\Models\State');

        $game->object = serialize($state);
        $game->guid = uniqid();
        $game->save();

        $user->game_id = $game->id;
        $user->save();

        $game = $setsUpAIGame->setup($game);
        $game->save();

        return $this->gameRenderer->renderGameForPlayer($game, $user);
    }

    /**
     * Takes the provided $guid and returns an html shell that can then used to join the game. If the player
     * already has an identity on the front-end, then they automatically join the game following a separate
     * AJAX request. Otherwise, they are prompted to provide a name and this then establishes an identity
     *
     * @return  \Illuminate\Http\Response
     */
    public function joinForm($guid) {
        $game = Game::where('guid', $guid)->first();

        return view('join', [
            'guid' => $game->guid
        ]);
    }

    /**
     * Takes the requesting player and adds them to an already existing game. A response for both players is
     * then returned to whichever service is responsible for distributing multiple responses
     */
    public function join(SetsUpTwoPlayerGame $setsUpNewPlayers, Request $request) {
        $user = $request->user;
        $game = Game::where('guid', $request->input('gameGuid'))->first();

        $user->game_id = $game->id;
        $user->save();

        $game = $setsUpNewPlayers->setup($game);
        $game->save();

        return $this->gameRenderer->renderGameForBothPlayers($game);
    }

    /**
     * Takes the input provided by the user and uses the their input and the Updater service to update the
     * game state. Then returns updated view to either single player in an AI game or both player's otherwise
     */
    public function update(Request $request, Updater $updater) {
        $user = $request->input('user');
        $game = $user->game;

        $updater->setState(unserialize($game->object));

        $updater->update(
            $request->input('action'),
            StringHelper::filterInput($request->input('input'))
        );
        $updater->resolve();

        $game->object = serialize($updater->state());
        $game->save();

        return $this->gameRenderer->renderGameForPlayer($game, $user);
    }

}
