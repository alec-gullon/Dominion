<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that adds actions to a player's current total
 */
class AddActions extends BaseEffect {

    /**
     * The number of cards that should be added to the players amount
     *
     * @var int
     */
    protected $amount;

    public function effect() {
        $this->state->addActions($this->amount);
        $this->description();
    }

    public function description() {
        $entry = 'gains ';
        if ($this->amount === 1) {
            $entry .= 'an action';
        } else {
            $entry .= $this->numberMappings[$this->amount] . ' actions';
        }
        $this->addToLog($entry);
    }

}