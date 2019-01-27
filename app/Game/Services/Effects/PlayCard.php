<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class PlayCard extends Base {

    public function effect() {
        $this->state->activePlayer()->playCard($this->params['stub']);
        $this->description();
    }

    public function description() {
        $card = CardFactory::build($this->params['stub']);
        $this->addToLog($this->state->activePlayer()->name() . ' plays ' . $card->nameWithArticlePrefix());
    }

}