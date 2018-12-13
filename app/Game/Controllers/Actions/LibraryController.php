<?php

namespace App\Game\Controllers\Actions;

class LibraryController extends ActionController {

    public function play() {
        $this->nextStep('reveal-cards');
    }

    public function revealCards() {
        $activePlayer = $this->activePlayer();
        while ($activePlayer->countHand() < 7 && $activePlayer->canDrawCard()) {
            $card = $activePlayer->getTopCard();
            if ($card->hasType('action')) {
                $this->nextStep('set-aside-card');
                $this->inputOn();
                return;
            }
            $activePlayer->drawCards(1);
        }
        $this->activePlayer()->moveCards('setAside', 'discard');
        $this->resolveCard();
    }

    public function setAsideCard($choice) {
        if ($choice) {
            $this->activePlayer()->setAsideTopCard();
        } else {
            $this->activePlayer()->drawCards(1);
        }
        $this->nextStep('reveal-cards');
        $this->inputOff();
    }

}