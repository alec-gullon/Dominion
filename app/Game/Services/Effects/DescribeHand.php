<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that describes the cards in a player's hand
 */
class DescribeHand extends BaseEffect {

    /**
     * The player who is having their hand described
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function description() {
        $entry = 'reveals a hand of' . $this->describeCardList($this->player->hand());
        $this->addToLog($entry, $this->player);
    }

}