<?php

namespace App\Game\Services\Setup;

class SetsUpTwoPlayerGame extends SetsUpGame {

    public function setup($game) {
        $players = $game->users;
        $state = unserialize($game->object);

        $player1 = $this->setUpPlayer($players[0]->guid);
        $player2 = $this->setUpPlayer($players[1]->guid);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId($player1->id());

        $game->object = serialize($state);
        return $game;
    }

}