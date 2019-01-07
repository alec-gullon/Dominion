<?php

namespace App\Game\Controllers\Actions;

class ChancellorController extends ActionController {

    public function play() {
        $this->nextStep('put-deck-in-discard');
        $this->gainCoins(2);
        $this->inputOn();
    }

    public function putDeckInDiscard($choice) {
        $entry = '.. ' . $this->activePlayer()->getName();
        if ($choice) {
            $entry .= ' puts their deck into their discard';
            $this->activePlayer()->moveCards('deck', 'discard');
        } else {
            $entry .= ' does not put their deck into their discard';
        }
        $this->addToLog($entry);
        $this->resolveCard();
    }

}