<?php

namespace App\Game\Services\Effects;

class TrashCards extends Base {

    public function effect() {
        $this->state->trashCards($this->params['cards']);
        $this->description();
    }

    public function description() {
        $cards = $this->params['cards'];

        $entry = '.. ' . $this->state->activePlayer()->getName() . ' trashes';

        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $cardStack = [];
            foreach ($cards as $stub) {
                $cardStack[] = $this->cardBuilder->build($stub);
            }
            $entry .= $this->describeCardlist($cardStack);
        }
        $this->addToLog($entry);
    }

}