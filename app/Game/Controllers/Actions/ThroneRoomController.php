<?php

namespace App\Game\Controllers\Actions;

class ThroneRoomController extends ActionController {

    public function play() {
        $this->setNextStep('duplicate-card');

        // if we've run out of action cards in hand, reset throne room count and resolve the duplicateCard step on all remaining throne room cards
        if (!$this->activePlayer()->hasCardsOfType('action')) {
            $this->activePlayer()->resolveAll();
        } else {
            $this->inputOn();
        }
    }

    public function duplicateCard($card) {
        $this->activePlayer()->playCard($card);
        $this->activePlayer()->playVirtualCard($card);
        $this->resolveCard();
        $this->inputOff();
    }

}