<?php

namespace App\Game\Services;

use App\Models\Game\Player;
use App\Services\CardBuilder;


class SetsUpNewPlayers {

    public function setup($game) {
        $players = $game->users;
        $state = unserialize($game->object);

        $player1 = new Player($players[0]->guid, new CardBuilder());
        $player1->setDeck($this->defaultDeck());
        $player1->shuffleDeck();
        $player1->drawCards(5);

        $player2 = new Player($players[1]->guid, new CardBuilder());
        $player2->setDeck($this->defaultDeck());
        $player1->shuffleDeck();
        $player1->drawCards(5);

        $state->setPlayers([$player1, $player2]);
        $state->setActivePlayerId($player1->getId());

        $game->object = serialize($state);
        return $game;
    }

    private function defaultDeck() {
        $cardBuilder = new CardBuilder();

        $deck = [];
        for ($i = 1; $i <= 3; $i++) {
            $deck[] = $cardBuilder->build('estate');
        }
        for ($i = 1; $i <= 7; $i++) {
            $deck[] = $cardBuilder->build('copper');
        }
        return $deck;
    }

}