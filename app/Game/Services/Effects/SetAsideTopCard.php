<?php

namespace App\Game\Services\Effects;

/**
 * Common card effect that sets aside a player's top card
 */
class SetAsideTopCard extends BaseEffect {

    public function effect() {
        $this->description();
        $this->state->activePlayer()->setAsideTopCard();
    }

    public function description() {
        $card = $this->state->activePlayer()->topCard();

        $entry = 'sets aside ' . $card->nameWithArticlePrefix();

        $this->addToLog($entry);
    }

}