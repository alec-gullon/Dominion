<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that discards a player's set aside cards
 */
class DiscardSetAsideCards extends BaseEffect {

    public function effect() {
        $this->description();
        $this->state->activePlayer()->moveCards('setAside', 'discard');
    }

    public function description() {
        $player = $this->state->activePlayer();
        $cards = $player->setAside;

        if (count($cards) === 0) {
            return;
        }

        $entry = 'discards' . $this->describeCardList($player->setAside) . ' that they set aside';

        $this->addToLog($entry);
    }

}