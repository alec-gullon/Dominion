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
        $cards = $player->setAside();

        if (count($cards) === 0) {
            return;
        }

        $entry = '.. ' . $player->name() . ' discards'
            . $this->describeCardList($player->setAside())
            . ' that they set aside';

        $this->addToLog($entry);
    }

}