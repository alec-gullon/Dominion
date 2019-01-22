<?php

namespace App\Game\Services\Effects;

use App\Services\Factories\CardFactory;

class BuyCard extends Base {

    public function effect() {
        $this->state->moveCardToPlayer($this->params['card']);
        $this->description();
    }

    public function description() {
        $card = CardFactory::build($this->params['card']);

        $description = '.. '
            . $this->activePlayerName()
            . ' buys '
            . $card->nameWithArticlePrefix();

        $this->addToLog($description);
    }

}