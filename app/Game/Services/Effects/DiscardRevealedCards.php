<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that discards the cards that a player has revealed
 */
class DiscardRevealedCards extends BaseEffect {

    /**
     * The player who is having their revealed cards discarded
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function effect() {
        $this->description();
        $this->player->moveCards('revealed', 'discard');
    }

    public function description() {
        $entry = 'discards' . $this->describeCardList($this->player->revealed) . ' from their revealed';
        $this->addToLog($entry, $this->player);
    }

}