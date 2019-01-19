<?php

namespace App\Game\Services\Setup;

use App\Models\Game\Player;
use App\Services\CardBuilder;

class SetsUpGame {

    protected function defaultDeck() {
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

    protected function setUpPlayer($guid, $isAi = false) {
        $player = new Player($guid, new CardBuilder(), $isAi);
        $player->setDeck($this->defaultDeck());
        $player->shuffleDeck();
        $player->drawCards(5);
        return $player;
    }

}