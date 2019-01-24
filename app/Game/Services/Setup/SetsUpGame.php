<?php

namespace App\Game\Services\Setup;

use App\Game\Services\GeneratesRandomKingdom;
use App\Game\Models\Player;
use App\Services\Factories\CardFactory;

class SetsUpGame {

    protected $generatesRandomKingdom;

    public function __construct(GeneratesRandomKingdom $generatesRandomKingdom) {
        $this->generatesRandomKingdom = $generatesRandomKingdom;
    }

    protected function defaultDeck() {
        $deck = [];
        for ($i = 1; $i <= 3; $i++) {
            $deck[] = CardFactory::build('estate');
        }
        for ($i = 1; $i <= 7; $i++) {
            $deck[] = CardFactory::build('copper');
        }
        return $deck;
    }

    protected function setUpPlayer($guid, $isAi = false) {
        $player = new Player($guid, $isAi);
        $player->setDeck($this->defaultDeck());
        $player->shuffleDeck();
        $player->drawCards(5);
        return $player;
    }

}