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

        $cards = $player->getRevealed();
        $entry = '.. ' . $player->getName() . ' discards';
        $entry .= $this->describeCardList($cards);
        $this->addToLog($entry);
    }

}