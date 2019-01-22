<?php

namespace App\Game\Services\Effects;

use App\Services\CardBuilder;

class DiscardCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $player->discardCards($this->params['cards']);
        $this->description();
    }

    public function description() {
        $player = $this->params['player'];
        $cards = CardBuilder::buildMultiple($this->params['cards']);

        $entry = '.. ' . $player->getName() . ' discards';
        if (count($cards) === 0) {
            $entry .= ' nothing';
        } else {
            $entry .= $this->describeCardList($cards);
        }

        $entry .= ' from their hand';
        $this->addToLog($entry);
    }

}