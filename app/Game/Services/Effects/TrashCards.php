<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

/**
 * Common card effect that trashes the selected cards from a player's hand
 */
class TrashCards extends BaseEffect {

    /**
     * An array of $stubs representing what cards are being trashed
     *
     * @var array
     */
    protected $stubs;

    public function effect() {
        $this->state->trashCards($this->stubs);
        $this->description();
    }

    public function description() {
        $cards = CardFactory::buildMultiple($this->stubs);

        $entry = 'trashes';
        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardlist($cards);
        }
        $this->addToLog($entry);
    }

}