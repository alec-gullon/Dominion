<?php

namespace App\Game\Services\Setup;

class SetsUpAIGame extends SetsUpGame {

    public function setup($game) {
        $player = $game->users[0];
        $state = unserialize($game->object);

        $player1 = $this->setUpPlayer($player->guid);
        $player2 = $this->setUpPlayer('Marvin', true);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId($player1->getId());

        $game->object = serialize($state);
        return $game;
    }

}