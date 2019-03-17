<?php

namespace App\Game\Services\Setup;

use App\Models\Game;

/**
 * Class responsible for taking a state that exists on a Game model and sets it up
 * ready to play from Turn 1 against an AI opponent
 */
class SetsUpAIGame extends SetsUpGame {

    /**
     * Sets the game up
     *
     * @param   \App\Models\Game    $game
     *
     * @return  \App\Models\Game
     */
    public function setup(Game $game) {
        $player = $game->users[0];
        $state = unserialize($game->object);

        $player1 = $this->setUpPlayer($player->guid, $player->name);
        $player2 = $this->setUpPlayer('marvin', 'Marvin', true);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId($player1->id);
        $state->setKingdomCards($this->generatesRandomKingdom->generate());

        $game->object = serialize($state);
        return $game;
    }

}