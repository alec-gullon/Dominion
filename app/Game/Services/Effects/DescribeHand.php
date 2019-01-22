<?php

namespace App\Game\Services\Effects;

class DescribeHand extends Base {

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->getName() . ' reveals a hand of';
        $entry .= $this->describeCardList($player->getHand());

        $this->addToLog($entry);
    }

}