<?php

namespace App\Game\Controllers\Actions;

/**
 * Controller responsible for resolving the Adventurer card when it has been played
 */
class AdventurerController extends ActionController {

    /**
     * Adjusts game state in line with an Adventurer card
     */
    public function play() {
        $activePlayer = $this->activePlayer();

        if (!$activePlayer->canDrawCard()) {
            $this->addPlayerActionToLog('has nothing to draw');
            return $this->resolveCard();
        }

        $revealedTreasure = 0;
        while ($activePlayer->canDrawCard() && $revealedTreasure < 2) {
            if ($activePlayer->topCard()->hasType('treasure')) {
                $revealedTreasure++;
            }
            $activePlayer->revealTopCard();
        }

        $this->describeRevealedCards();
        $this->moveCards('revealed', 'hand', 'treasure');
        $this->moveCards('revealed', 'discard');

        $this->resolveCard();
    }

}