<?php

namespace App\Game\Controllers\Actions;

class ChancellorController extends ActionController {

    public function play() {
        $this->setNextStep('put-deck-in-discard');
        $this->addCoins(2);
        $this->inputOn();
    }

    public function putDeckInDiscard($choice) {
        if ($choice) {
            $this->combinePiles('deck', 'discard');
            return $this->resolveCard();
        }
        $this->addToLog('does not put their deck into their discard');
        $this->resolveCard();
    }

}