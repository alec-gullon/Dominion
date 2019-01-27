<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that lets a player buy a card
 */
class BuyCard extends BaseEffect {

    /**
     * A $stub representing what card is being bought
     *
     * @var string
     */
    protected $stub;

    public function effect() {
        $this->state->moveCardToPlayer($this->stub);
        $this->description();
    }

    public function description() {
        $card = $this->buildCard($this->stub);

        $description = 'buys ' . $card->nameWithArticlePrefix();

        $this->addToLog($description, null, 0);
    }

}