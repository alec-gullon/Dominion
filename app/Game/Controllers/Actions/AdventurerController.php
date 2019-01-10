<?php

namespace App\Game\Controllers\Actions;

class AdventurerController extends ActionController {

    public function play() {
        if (!$this->activePlayer()->canDrawCard()) {
            $this->addToLog( '.. ' . $this->activePlayer()->getName() . ' has nothing to draw');
            $this->resolveCard();
            return;
        }

        $revealedTreasure = 0;
        while ($this->activePlayer()->canDrawCard() && $revealedTreasure < 2) {
            $card = $this->activePlayer()->getTopCard();
            if ($card->hasType('treasure')) {
                $revealedTreasure++;
            }
            $this->activePlayer()->revealTopCard();
        }

        $this->describeRevealedCards();
        $this->moveCards('revealed', 'hand', 'treasure');
        $this->moveCards('revealed', 'discard');

        $this->resolveCard();
    }

}