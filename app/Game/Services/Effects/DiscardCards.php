<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class DiscardCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $player->discardCards($this->params['cards']);
        $this->description();
    }

    public function description() {
        $player = $this->params['player'];
        $cards = CardFactory::buildMultiple($this->params['cards']);

        $entry = '.. ' . $player->name() . ' discards';
        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardList($cards);
        }

        $entry .= ' from their hand';
        $this->addToLog($entry);
    }

}