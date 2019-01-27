<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

/**
 * Common card effect that discards cards from a players hand
 */
class DiscardCards extends BaseEffect {

    /**
     * The player who is discarding their cards
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    /**
     * The set of cards that are being discarded
     *
     * @var array
     */
    protected $stubs;

    public function effect() {
        $this->player->discardCards($this->stubs);
        $this->description();
    }

    public function description() {
        $cardStack = CardFactory::buildMultiple($this->stubs);

        $entry = 'discards';
        if (count($cardStack) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardList($cardStack);
        }

        $entry .= ' from their hand';
        $this->addToLog($entry, $this->player);
    }

}