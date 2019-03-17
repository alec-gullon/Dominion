<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Chapel card that has been played
 */
class ChapelStrategy extends CardStrategy {

    /**
     * A list of stubs that represent cards the AI would want to trash
     *
     * @var array
     */
    private $trashableCards = [
        'estate',
        'curse',
        'copper'
    ];

    public function trashSelectedCards() {
        $handCards = $this->state->activePlayer()->hand;

        $cardsToTrash = [];
        foreach ($handCards as $handCard) {
            if (in_array($handCard->stub, $this->trashableCards)) {
                $cardsToTrash[] = $handCard->stub;
            }
        }

        return $cardsToTrash;
    }

}