<?php

namespace App\Game\Services\Effects;

use App\Models\Game\Player;

class DiscardCards extends Base {

    public function effect() {
        $player = $this->params['player'];

        $player->discardCards($this->params['cards']);
        $this->description();
    }

    public function description() {
        $cards = $this->params['cards'];
        $player = $this->params['player'];

        $cardStack = [];
        foreach ($cards as $stub) {
            $cardStack[] = $this->cardBuilder->build($stub);
        }
        $entry = '.. ' . $player->getName() . ' discards';
        $entry .= $this->describeCardList($cardStack);
        $entry .= ' from their hand';
        $this->addToLog($entry);
    }

}