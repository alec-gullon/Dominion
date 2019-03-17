<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that adds coins to a player's current total
 */
class AddCoins extends BaseEffect {

    /**
     * The number of coins that should be added to the player's total
     *
     * @var int
     */
    protected $amount;

    public function effect() {
        $this->state->coins += $this->amount;
        $this->description();
    }

    public function description() {
        $entry = 'gains ';
        if ($this->amount === 1) {
            $entry .= 'a coin';
        } else {
            $entry .= $this->numberMappings[$this->amount] . ' coins';
        }
        $this->addToLog($entry);
    }

}

