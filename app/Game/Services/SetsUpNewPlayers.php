<?php

namespace App\Game\Services;

use App\Models\Game\Player;
use App\Services\CardBuilder;


class SetsUpNewPlayers {

    public function setup($game) {
        $players = $game->users;
        $state = unserialize($game->object);

        $player1 = new Player($players[0]->guid, new CardBuilder());
        $player1->buildDefaultDeck();

        $player2 = new Player($players[1]->guid, new CardBuilder());
        $player2->buildDefaultDeck();

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerKey($player1->getId());

        $game->object = serialize($state);
        return $game;
    }

}