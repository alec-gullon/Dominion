<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that adds buys to a player's current total
 */
class AddBuys extends BaseEffect {

    /**
     * The number of buys that should be added to the player's total
     *
     * @var int
     */
    protected $amount;

    public function effect() {
        $this->state->buys += $this->amount;
        $this->description();
    }

    public function description() {
        $entry = 'gains ';
        if ($this->amount === 1) {
            $entry .= 'a buy';
        } else {
            $entry .= $this->numberMappings[$this->amount] . ' buys';
        }
        $this->addToLog($entry);
    }

}

