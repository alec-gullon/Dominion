<?php

namespace App\Game\Services\Effects;

class DescribeRevealedCards extends Base {

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->getName() . ' reveals';
        $revealedCards = $player->revealed();
        $entry .= $this->describeCardList($revealedCards);
        $this->addToLog($entry);
    }

}