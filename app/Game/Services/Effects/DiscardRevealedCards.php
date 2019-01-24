<?php

namespace App\Game\Services\Effects;

use App\Game\Models\Player;

class DiscardRevealedCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $this->description();
        $player->moveCards('revealed', 'discard');
    }

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->getName() . ' discards'
            . $this->describeCardList($player->revealed())
            . ' from their revealed';

        $this->addToLog($entry);
    }

}