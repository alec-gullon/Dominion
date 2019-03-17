<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that takes a card from the kingdom and places it somewhere in
 * the player's control
 */
class GainCard extends BaseEffect {

    /**
     * A $stub representing what card the player is gaining
     *
     * @var string
     */
    protected $stub;

    /**
     * Where the gained card should be placed e.g., in the player's discard/hand/on top of their deck
     *
     * @var string
     */
    protected $location;

    /**
     * The player who is gaining a card
     *
     * @var \App\Game\Models\Player
     */
    protected $player;

    public function effect() {
        $this->state->moveCardToPlayer(
            $this->stub,
            $this->location,
            $this->player->id
        );
        $this->description();
    }

    public function description() {
        if ($this->state->kingdomCards[$this->stub] === 0) {
            if ($this->location === 'deck') {
                $entry = 'places nothing on their deck';
            } else {
                $entry = 'gains nothing';
            }
        } else {
            $card = $this->buildCard($this->stub);
            $entry = 'gains ' . $card->nameWithArticlePrefix();

            if ($this->location === 'deck') {
                $entry .= ', putting it on top of their deck';
            } else if ($this->location === 'hand') {
                $entry .= ', putting it in their hand';
            }
        }

        $this->addToLog($entry, $this->player);
    }

}