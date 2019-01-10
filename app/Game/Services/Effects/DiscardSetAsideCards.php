<?php

namespace App\Game\Services\Effects;

use App\Models\Game\Player;

class DiscardSetAsideCards extends Base {

    public function effect() {
        $player = $this->state->getActivePlayer();
        $cards = $player->getSetAside();
        if (count($cards) === 0) {
            return;
        }
        $player->moveCards('setAside', 'discard');
        $this->description($cards, $player);
    }

    public function description($cards, Player $player) {
        $entry = '.. ' . $player->getName() . ' discards';
        $entry .= $this->describeCardList($cards);
        $entry .= ' that they set aside';
        $this->addToLog($entry);
    }

}