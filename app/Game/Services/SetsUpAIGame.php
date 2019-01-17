<?php

namespace App\Game\Services;

use App\Models\Game\Player;
use App\Services\CardBuilder;


class SetsUpAIGame {

    public function setup($game) {

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