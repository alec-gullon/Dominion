<?php

namespace App\Game\Services\Effects;

class DiscardSetAsideCards extends Base {

    public function effect() {
        $player = $this->state->activePlayer();

        $this->description();
        $player->moveCards('setAside', 'discard');
    }

    public function description() {
        $player = $this->state->activePlayer();
        $cards = $player->getSetAside();

        if (count($cards) === 0) {
            return;
        }

        $entry = '.. ' . $player->getName() . ' discards'
            . $this->describeCardList($player->getSetAside())
            . ' that they set aside';

        $this->addToLog($entry);
    }

}