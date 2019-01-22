<?php

namespace App\Game\Services\Effects;

class DescribeRevealedCards extends Base {

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->getName()
            . ' reveals'
            . $this->describeCardList($player->revealed());

        $this->addToLog($entry);
    }

}