<?php

namespace App\Game\Services\Effects;

use App\Game\Factories\CardFactory;

class BuyCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer($this->params['stub']);
        $this->description();
    }

    public function description() {
        $card = CardFactory::build($this->params['stub']);

        $description = '.. '
            . $this->activePlayerName()
            . ' buys '
            . $card->nameWithArticlePrefix();

        $this->addToLog($description);
    }

}