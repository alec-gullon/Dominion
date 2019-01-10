<?php

namespace App\Game\Services\Effects;

class DescribeHand extends Base {

    public function description() {
        $player = $this->params['player'];

        $cards = $player->getHand();
        $entry = '.. ' . $player->getName() . ' reveals a hand of';
        $entry .= $this->describeCardList($cards);
        $this->addToLog($entry);
    }

}