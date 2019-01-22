<?php

namespace App\Game\Services\Effects;

use App\Services\Factories\CardFactory;

class TrashCards extends Base {

    public function effect() {
        $this->state->trashCards($this->params['cards']);
        $this->description();
    }

    public function description() {
        $cards = CardFactory::buildMultiple($this->params['cards']);

        $entry = '.. ' . $this->activePlayerName() . ' trashes';

        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardlist($cards);
        }
        $this->addToLog($entry);
    }

}