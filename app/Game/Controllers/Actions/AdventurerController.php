<?php

namespace App\Game\Controllers\Actions;

class AdventurerController extends ActionController {

    public function play() {
        $activePlayer = $this->activePlayer();

        if (!$activePlayer->canDrawCard()) {
            $this->addPlayerActionToLog('has nothing to draw');
            return $this->resolveCard();
        }

        $revealedTreasure = 0;
        while ($activePlayer->canDrawCard() && $revealedTreasure < 2) {
            if ($activePlayer->getTopCard()->hasType('treasure')) {
                $revealedTreasure++;
            }
            $activePlayer->revealTopCard();
        }

        $this->describeRevealedCards();
        $this->moveCards('revealed', 'hand', 'treasure');
        $this->moveCards('revealed', 'discard');

        return $this->resolveCard();
    }

}