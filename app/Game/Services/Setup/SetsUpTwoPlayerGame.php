<?php

namespace App\Game\Services\Setup;

use App\Models\Game;

/**
 * Class responsible for taking a state that exists on a Game model and sets it up
 * ready to play from Turn 1 between two human players
 */
class SetsUpTwoPlayerGame extends SetsUpGame {

    /**
     * Sets the game up
     *
     * @param   \App\Models\Game    $game
     *
     * @return  \App\Models\Game
     */
    public function setup(Game $game) {
        $players = $game->users;
        $state = unserialize($game->object);

        $player1 = $this->setUpPlayer($players[0]->guid, $players[0]->name);
        $player2 = $this->setUpPlayer($players[1]->guid, $players[1]->name);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId($player1->id());
        $state->setKingdomCards($this->generatesRandomKingdom->generate());

        $game->object = serialize($state);
        return $game;
    }

}