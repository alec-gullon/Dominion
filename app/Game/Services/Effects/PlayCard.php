<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that adds actions to a player's current total
 */
class PlayCard extends BaseEffect {

    /**
     * A $stub representing which card is being played
     *
     * @var string
     */
    protected $stub;

    public function effect() {
        $this->state->activePlayer()->playCard($this->stub);
        $this->description();
    }

    public function description() {
        $card = $this->buildCard($this->stub);
        $this->addToLog('plays ' . $card->nameWithArticlePrefix(), null, 0);
    }

}