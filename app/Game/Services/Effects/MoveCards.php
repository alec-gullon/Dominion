<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that moves cards of a certain type from one player location to another
 */
class MoveCards extends BaseEffect {

    /**
     * What area of the player's state the cards are being moved from
     *
     * @var string
     */
    protected $from;

    /**
     * What area of the player's state the cards are being moved to
     *
     * @var string
     */
    protected $where;

    /**
     * What type of cards should be moved. If set to 'all', then all cards are moved from the target
     * location
     *
     * @var string
     */
    protected $type;

    /**
     * The player who is having their cards moved
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function effect() {
        $this->description();
        $this->player->moveCardsOfType(
            $this->from,
            $this->where,
            $this->type
        );
    }

    public function description() {
        $player = $this->player;

        $cardsToMove = $player->getCardsOfType(
            $this->from,
            $this->type
        );

        if (count($cardsToMove) === 0) {
            $entry = 'does not put anything';
        } else {
            $entry = 'puts';
        }
        $entry .= $this->describeCardList($cardsToMove);
        $entry .= ' into their ' . $this->where;
        $this->addToLog($entry, $player);
    }

}