<?php

namespace App\Game\Services\AI\Strategies\Actions;

/**
 * Provides the AI with an appropriate decision to resolve a Remodel card that has been played
 */
class RemodelStrategy extends CardStrategy {

    /**
     * Selects a card for the AI to trash
     *
     * @return  string
     */
    public function trashCard() {
        $handCards = $this->state->activePlayer()->hand;
        return $this->prioritisedCard($handCards, 'trashPriority');
    }

    /**
     * Selects a card for the AI to trash after they have trashed something
     *
     * @return  string
     */
    public function gainSelectedCard() {
        $cardStack = $this->remainingKingdomCardStack();
        return $this->prioritisedCard($cardStack, 'gainPriority');
    }

    /**
     * Priority for what card to gain. Special precedence is given to cards which are Attack cards,
     * or which are non-copper treasure cards
     *
     * @param   object      $card
     *
     * @return  int
     */
    public function gainPriority($card) {
        $gainValue = $this->activePlayer()->unresolvedCard()->gainValue;

        $priority = $card->value;
        if ($card->hasType('attack'))                                       $priority += 100;
        if ($card->hasType('treasure') && $card->value > 3)               $priority += 10;
        if ($card->value > $gainValue)                                    $priority = -1;
        return $priority;
    }

    /**
     * Priority for what card to trash. Priority is afforded to Estate cards and then
     * increasingly low value ones
     *
     * @param   object      $card
     *
     * @return  int
     */
    public function trashPriority($card) {
        $priority = $card->value;
        if ($card->stub === 'estate')                $priority += 10;
        return $priority;
    }

}