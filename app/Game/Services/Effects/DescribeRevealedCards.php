<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that describes the cards that a player has revealed
 */
class DescribeRevealedCards extends BaseEffect {

    /**
     * The player who is having their revealed cards described
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function description() {
        $entry = 'reveals' . $this->describeCardList($this->player->revealed());
        $this->addToLog($entry, $this->player);
    }

}