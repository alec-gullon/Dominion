<?php

namespace App\Game\Controllers\Actions;

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

        $this->describeRevealedCards();
        $this->moveCardsOfType('revealed', 'hand', 'treasure');
        $this->moveCards('revealed', 'discard');

        $this->resolveCard();
    }

}