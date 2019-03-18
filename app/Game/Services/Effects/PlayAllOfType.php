<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that plays all cards of a particular type from the player's hand
 */
class PlayAllOfType extends BaseEffect {

    /**
     * The type of card that should be played
     *
     * @var string
     */
    protected $type;

    public function effect() {
        $cards = $this->state->activePlayer()->getCardsOfType('hand', $this->type);

        $this->description();

        foreach ($cards as $card) {
            if ($card->hasType('treasure')) {
                $this->state->coins += $card->denomination;
            }
            $this->state->activePlayer()->playCard($card->stub);
        }
    }

    public function description() {
        $cards = $this->state->activePlayer()->getCardsOfType('hand', $this->type);

        $entry = 'plays' . $this->describeCardList($cards);
        $this->addToLog($entry, null, 0);
    }

}