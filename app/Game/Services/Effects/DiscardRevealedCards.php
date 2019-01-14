<?php

namespace App\Game\Services\Effects;

use App\Models\Game\Player;

class DiscardRevealedCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $this->description();
        $player->moveCards('revealed', 'discard');
    }

    public function description() {
        $player = $this->params['player'];

        $cards = $player->revealed();
        $entry = '.. ' . $player->getName() . ' discards';
        $entry .= $this->describeCardList($cards);
        $entry .= ' from their revealed';
        $this->addToLog($entry);
    }

}