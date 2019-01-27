<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that draws cards from a player's deck into their hand
 */
class DrawCards extends BaseEffect {

    /**
     * How many cards to (try and) draw
     *
     * @var int
     */
    protected $amount;

    /**
     * The player who is drawing cards
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function effect() {
        $remainingCards = $this->player->numberOfDrawableCards();
        $this->player->drawCards($this->amount);

        if ($remainingCards < $this->amount) {
            $this->amount = $remainingCards;
        }
        $this->description();
    }

    public function description() {
        if ($this->amount === 0) {
            $entry = 'draws nothing';
        } else if ($this->amount === 1) {
            $entry = 'draws a card';
        } else {
            $entry = 'draws ' . $this->numberMappings[$this->amount] . ' cards';
        }

        $this->addToLog($entry, $this->player);
    }

}