<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class TrashCards extends Base {

    public function effect() {
        $this->state->trashCards($this->params['stubs']);
        $this->description();
    }

    public function description() {
        $cards = CardFactory::buildMultiple($this->params['stubs']);

        $entry = '.. ' . $this->activePlayerName() . ' trashes';

        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardlist($cards);
        }
        $this->addToLog($entry);
    }

}