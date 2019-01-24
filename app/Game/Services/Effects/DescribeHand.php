<?php

namespace App\Game\Services\Effects;

class DescribeHand extends Base {

    public function description() {
        $player = $this->params['player'];

        $entry = '.. ' . $player->name() . ' reveals a hand of';
        $entry .= $this->describeCardList($player->hand());

        $this->addToLog($entry);
    }

}