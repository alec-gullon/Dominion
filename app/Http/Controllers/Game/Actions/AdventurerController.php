<?php

namespace App\Http\Controllers\Game;

class AdventurerController extends ActionController {

    public function play() {
        $revealedTreasure = 0;
        while ($this->activePlayer()->canDrawCard() && $revealedTreasure < 2) {
            $card = $this->activePlayer()->getTopCard();
            if ($card->hasType('treasure')) {
                $revealedTreasure++;
            }
            $this->activePlayer()->revealTopCard();
        }

        $this->activePlayer()->moveCardsOfType('revealed', 'hand', 'treasure');
        $this->activePlayer()->moveCards('revealed', 'discard');

        $this->resolveCard();
    }

}