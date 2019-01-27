<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that moves a certain card from a particular and places it on top of the
 * player's deck
 */
class MoveCardOntoDeck extends BaseEffect {

    /**
     * The player who is placing the card on top of their deck
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    /**
     * A stub representing what card is being moved
     *
     * @var string
     */
    protected $stub;

    /**
     * A stub representing the location that the card is being moved to
     *
     * @var string
     */
    protected $from;

    public function effect() {
        $this->description();
        $this->player->moveCardOntoDeck(
            $this->stub,
            $this->from
        );
    }

    public function description() {
        $card = $this->buildCard($this->stub);

        if ($this->from === 'revealed') {
            $entry = 'places the ' . $card->name() . ' on top of their deck';
        } else {
            $entry = 'places ' . $card->nameWithArticlePrefix() . ' onto their deck from their ' . $this->from;
        }
        $this->addToLog($entry, $this->player);
    }

}